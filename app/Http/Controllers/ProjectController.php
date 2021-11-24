<?php

namespace App\Http\Controllers;

use App\Models\Browser;
use App\Models\Category;
use App\Models\Compatible;
use App\Models\Files;
use App\Models\Layout;
use App\Models\Project;
use App\Models\ProjectBrowser;
use App\Models\ProjectCategory;
use App\Models\ProjectCompatible;
use App\Models\ProjectFeature;
use App\Models\ProjectKeyValue;
use App\Models\ProjectLike;
use App\Models\ProjectTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;

class ProjectController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        //  DB::raw("(SELECT project_id, array_to_json(array_agg(category_id)) FROM project_categories) as  prod_categories"),
        $search = \request()->get('search');
        $search = str_replace(['"', "'"], '_', $search);
        $projects = Project::select(
                'id',
                'name',
                'slug',
                'sale_price',
                'price',
                'sales',
                'view',
                'category_id',
                'demo_url',
                'submit',
                'category_name',
                'preview_image as cover',
                'preview_image_watermark',
                'file',
                'originalFile',
                'main_file',
                DB::raw("(SELECT name FROM categories WHERE id = projects.category_id) as  category"),
                DB::raw("(SELECT type FROM categories WHERE id = projects.category_id) as  category_type"),
                DB::raw("(SELECT username FROM users WHERE id = projects.user_id) as  user"),
                DB::raw("(SELECT array_to_json(array_agg(rating)) FROM reviews  WHERE project_id = projects.id) as  ratings"),
                DB::raw("(SELECT array_to_json(array_agg(raw_)) FROM (SELECT name,parent_id FROM categories
             WHERE id IN (SELECT category_id FROM project_categories WHERE category_id = categories.id) ) as raw_) as  categories"),
            )
            ->where('deleted_at', null);
        if ($search != '') {
            $projects->where('projects.name', 'ilike', '%' . $search . '%')
                ->orWhere('projects.slug', 'ilike', '%' . $search . '%')
                ->orWhere('projects.sale_price', 'LIKE', '%' . $search . '%')
                ->orWhere('projects.description', 'LIKE', '%' . $search . '%')
                ->orWhereIn('projects.id', [DB::raw("SELECT project_id FROM project_tags WHERE name ILIKE '%$search%'")])
                ->orWhereIn('projects.id', [DB::raw("SELECT project_id FROM project_features WHERE feature ILIKE '%$search%'")]);
        }

            $projects = $projects->orderBy('id', 'DESC')->paginate(30);

        return view('project.projects', compact('projects'));
    }

    public function project_detail($slug)
    {
        $project = DB::table('projects')
            ->select(
                'id',
                'name',
                'user_id',
                'slug',
                'description',
                'high_resolution',
                'documentation',
                'columns',
                'sale_price',
                'famous_man',
                'zip_size',
                'pbr',
                'vertex_colors',
                'rigged_geometries',
                'uv_layers',
                'scale_transformations',
                'geometry',
                'vertices',
                'materials',
                'textures',
                'animations',
                'morph_geometry',
                'price',
                'sales',
                'view',
                'created_at',
                'updated_at',
                'demo_url',
                'file as preview_file',
                'originalFile as original_file',
                'preview_image as cover',
                'preview_image_watermark',

                DB::raw("(SELECT array_to_json(array_agg(name)) FROM project_tags WHERE project_id = projects.id) as  tags"),
//                DB::raw("(SELECT array_to_json(array_agg(feature)) FROM project_features WHERE project_id = projects.id) as  features"),
                DB::raw("(SELECT name FROM categories WHERE id = projects.category_id) as  category"),
                DB::raw("(SELECT type FROM categories WHERE id = projects.category_id) as  category_type"),
                DB::raw("(SELECT array_to_json(array_agg(row_to_json(raw))) FROM (SELECT key, value FROM project_key_values WHERE project_id = projects.id) as raw) as  specials"),

                DB::raw("(SELECT row_to_json(raw) FROM (SELECT * FROM layouts WHERE id=projects.layout_id) as raw ) as layout"),

                DB::raw("(SELECT row_to_json(raw) FROM (SELECT CONCAT(first_name ,' ', last_name) as full_name, created_at, username,profile_image ,facebook,instagram,twitter,pinterest FROM users WHERE id=projects.user_id) as raw ) as user"),

                DB::raw("(SELECT array_to_json(array_agg(row_to_json(raw_))) FROM (select id,project_id,mime_type,file ,size,image_width,image_height,mime_type from files WHERE project_id=projects.id ) as raw_ WHERE project_id = projects.id) as  files"),

                DB::raw("(SELECT array_to_json(array_agg(raw_)) FROM (SELECT name,slug FROM browsers
            WHERE id IN (SELECT browser_id FROM project_browsers WHERE browser_id = browsers.id AND project_id = projects.id)) as raw_) as  browsers"),

                DB::raw("(SELECT array_to_json(array_agg(raw_)) FROM (SELECT slug,name FROM categories
            WHERE id IN (SELECT category_id FROM project_categories WHERE category_id = categories.id AND project_id = projects.id)) as raw_) as  categories"),

                DB::raw("(SELECT array_to_json(array_agg(raw_)) FROM (SELECT name FROM compatibles
            WHERE id IN (SELECT compatible_id FROM project_compatibles WHERE compatible_id = compatibles.id  AND project_id = projects.id)) as raw_) as  compatibles"),

            )
            ->where('projects.slug', $slug)
            ->groupBy('projects.id')
            ->first();

        if (!$project) {
            abort(404);
        }
        $comments = DB::table('comments')->select(

            DB::raw("(SELECT row_to_json(raw) FROM (SELECT CONCAT(first_name ,' ', last_name) as full_name, created_at, username,profile_image  FROM users WHERE id=comments.user_id) as raw ) as user"),
            'comment',
            'comments.id',
            'comments.created_at'
        )->where('project_id', $project->id)
            ->where('deleted_at', null)
            ->paginate(10);


        $id = $project->id;

        $reviews = DB::table('reviews')
            ->select(
                'id',
                "review",
                "review_id",
                "user_id",
                'created_at',
                'rating',
                "user_id",
                DB::raw("(SELECT username FROM users where id=reviews.user_id) as user"),
                DB::raw("(SELECT name FROM review_categories where id=reviews.cat_review_id) as category"),

                DB::raw("(SELECT array_to_json(array_agg(review)) FROM reviews as reply WHERE review_id = reviews.id AND user_id = user_id) as  reply"),

                DB::raw("(SELECT array_to_json(array_agg(raw_)) FROM (SELECT username,profile_image FROM users
                WHERE id IN (SELECT user_id FROM reviews as reply WHERE review_id = reviews.id )) as raw_) as  reply_user"),

            )
            ->where('review_id', null)
            ->where('project_id', $id)->paginate(10);
        $ratings = DB::table('reviews')
            ->select(
                DB::raw("(SELECT array_to_json(array_agg(rating)) FROM reviews  WHERE project_id = $id) as  ratings"),

            )
            ->where('review_id', null)
            ->where('project_id', $id)
            ->groupBy('project_id')
            ->first();

        $likes = ProjectLike::where('project_id', $project->id)->count();
        return view('project.detail', compact('project', 'ratings', 'likes', 'id', 'comments', 'reviews'));
    }

    public function upload()
    {
        // $categories = Category::where('type', '!=', null)->get();
        $categories = Category::where('type', '!=', null)->where('sub_id', null)->get();
        $files = Files::where('project_id', null)->where('user_id', Auth::id())->get();
        $compatibles = Compatible::all();
        $layouts = Layout::all();
        $browsers = Browser::all();
        return view('project.upload', compact('categories', 'files', 'compatibles', 'browsers', 'layouts'));
    }

    public function edit($id)
    {
        $categories = Category::where('type', '!=', null)->where('sub_id', null)->get();
        $browsers = Browser::all();
        $compatibles = Compatible::all();
        $layouts = Layout::all();

        $files = Files::where('project_id', $id)->where('user_id', Auth::id())->get();
        $project_browsers = ProjectBrowser::where('project_id', $id)->get();
        $other_categories = ProjectCategory::where('project_id', $id)->get();
        $project_compatibles = ProjectCompatible::where('project_id', $id)->get();
        $project_features = ProjectFeature::where('project_id', $id)->get();
        $project_specials = ProjectKeyValue::where('project_id', $id)->get();
        $project_tags = ProjectTags::where('project_id', $id)->get();


        $category_type = Project::select('type')->leftJoin('categories', 'projects.category_id', '=', 'categories.id')->where('projects.id', $id)->first()->type;
        $tags = '';
        $other_categories_id = '';
        foreach ($project_tags as $key => $value) {
            if ($key == 0) {
                $tags .= $value->name;
            } else {
                $tags .= ',' . $value->name;
            }
        }
        $project = Project::where('id', $id)->first();
        if (!$project) {
            abort(404);
        }
        foreach ($other_categories as $key => $value) {
            if ($key == 0) {
                $other_categories_id .= $value->category_id;
            } else {
                $other_categories_id .= ',' . $value->category_id;
            }
        }
        return view('project.edit', compact('id', 'categories', 'files', 'other_categories_id', 'compatibles', 'project_browsers', 'other_categories', 'project_compatibles', 'project_features', 'tags', 'layouts', 'browsers', 'project', 'project_specials', 'category_type'));
    }


    public function store(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $sale_price = $request->sale_price;
        $first_category = $request->first_category;
        $layout_id = $request->layout_id;
        $demo_url = $request->demo_url;
        $columns = $request->columns;
        $high_resolution = $request->high_resolution;
        $documentation = $request->documentation;
        $compatible_with = $request->compatible_with;
        $tags = $request->tags;
        $features = $request->features;
        $browsers = $request->browsers;
        $other_categories = $request->other_categories;

        $specials_key = $request->specials_key;
        $specials_value = $request->specials_value;




        $preview_image = $request->file('preview_image');
        $main_file = $request->file('main_file');
        $file = $request->file('preview_file');
        $mimeType = '';

        $time = time();

        if ($sale_price <= $price) {
            $a = $price;
            $b = $sale_price;
            $sale_price = $a;
            $price = $b;
        }
        if ($file != '') {
            $originalNameFile = $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            $type = explode('/', $mimeType)[0];
            if ($type == 'audio') {
                $audio_name = str_replace('public', 'storage', $file->store('public/audio'));
                $newName = public_path() . '/storage/sound-track/' . $time . '.mp3';
                $command = 'ffmpeg -i ' . public_path() . '/' . $audio_name . ' -filter_complex "amovie=' . public_path() . '/hajmalabs.mp3:loop=999[s];[0][s]amix=duration=shortest" ' . $newName;

                exec($command);

                $originalFile = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($audio_name));
                $file = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset('/storage/sound-track/' . $time . '.mp3'));
            }
            if ($type == 'video') {
                $video_name = str_replace('public', 'storage', $file->store('public/video'));
                $newName = public_path() . '/storage/video-track/' . $time . '.mp4';
                $command = 'ffmpeg -i ' . public_path() . '/' . $video_name . ' -i ' . public_path() . '/hajmalabs.mp3 -codec:v copy -codec:a aac -b:a 192k -strict experimental -ac 2 -shortest ' . $newName;
                exec($command);
                $originalFile = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($video_name));
                $file = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset('/storage/video-track/' . $time . '.mp4'));
            }
        }
        if ($preview_image != '') {
            $hajmafile = str_replace('public', 'storage', asset($preview_image->store('public/cover-images')));
            $preview_image = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($preview_image->store('public/cover-images')));
            $cretaImage = '';
            if ($mimeType == 'image/jpeg') {
                $cretaImage = imagecreatefromjpeg($hajmafile);
            } elseif ($mimeType == 'image/png') {
                $cretaImage = imagecreatefrompng($hajmafile);
            }
            if ($cretaImage != '') {
                $image_width = imagesx($cretaImage);
                $image_height = imagesy($cretaImage);
                $stamp = imagecreatefrompng('text3.png');
                $stamp = imagescale($stamp, $image_width / 1.5);
                $sx = imagesx($stamp);
                $sy = imagesy($stamp);
                imagecopy(
                    $cretaImage,
                    $stamp,
                    ($image_width / 2) - ($sx / 2),
                    ($image_height / 2) - ($sy / 2),
                    0,
                    0,
                    $sx,
                    $sy
                );
                header('Content-type: image/png');
                imagepng($cretaImage, $hajmafile);
                imagedestroy($cretaImage);
            }
            // $mimeType = $preview_image->getMimeType();
            // $hajmafile = '';
            // if ($mimeType == 'image/jpeg' || $mimeType == 'image/png') {
            //     $hajmafile = str_replace('public', 'storage', $preview_image->store('public/project'));
            // }
            // $image = '';

            // if ($mimeType == 'image/jpeg') {
            //     $image = imagecreatefromjpeg($hajmafile);
            // } elseif ($mimeType == 'image/png') {
            //     $image = imagecreatefrompng($hajmafile);
            // }
            // if ($image != '') {
            //     $preview_image = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($preview_image->store('public/cover-images')));
            //     $image_width =  imagesx($image);
            //     $image_height =  imagesy($image);
            //     $stamp = imagecreatefrompng('text3.png');
            //     $stamp = imagescale($stamp, $image_width / 5);
            //     $marge_right = 50;
            //     $marge_bottom = 50;
            //     $sx = imagesx($stamp);
            //     $sy = imagesy($stamp);
            //     imagecopy(
            //         $image,
            //         $stamp,
            //         $image_width - $sx - $marge_right,
            //         $image_height - $sy - $marge_bottom,
            //         0,
            //         0,
            //         $sx,
            //         $sy
            //     );
            //     header('Content-type: image/png');
            //     imagepng($image, $hajmafile);
            //     imagedestroy($image);
            // }
        }

        if ($id == null) {
            $project = new Project();
            $project->user_id = Auth::id();
            $project->name = $title;
            $project->slug = Str::slug($title, '-');
            $project->category_id = $first_category;
            $project->description = $description;
            $project->high_resolution = $high_resolution;
            $project->documentation = $documentation;
            $project->columns = $columns;
            if ($sale_price > $price) {
                $project->price = $price;
                $project->sale_price = $sale_price;
            } else {
                $project->sale_price = $sale_price;
            }
            $project->layout_id = $layout_id;
            $project->submit = 1;
            $project->demo_url = $demo_url;

            $project->preview_image = $preview_image;
            if ($file != '') {
                $project->file = $file;
                $project->originalFile = $originalFile;
                $project->file_name = $originalNameFile;
            }
            if ($main_file != '') {
                $originalName = $main_file->getClientOriginalName();
                $main_file = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($main_file->store('public/project-main-files')));
                $project->main_file = $main_file;
                $project->file_name = $originalName;
            }
            $project->save();
            if (isset($browsers)) {
                foreach ($browsers as $browser) {
                    $add = new ProjectBrowser();
                    $add->project_id = $project->id;
                    $add->browser_id = $browser;
                    $add->save();
                }
            }
            if (isset($tags)) {
                foreach ($tags as $tag) {
                    $add = new ProjectTags();
                    $add->project_id = $project->id;
                    $add->name = $tag;
                    $add->save();
                }
            }

            if (isset($other_categories)) {
                foreach ($other_categories as $category) {
                    $add = new ProjectCategory();
                    $add->project_id = $project->id;
                    $add->category_id = $category;
                    $add->save();
                }
            }
            if (isset($compatible_with)) {
                foreach ($compatible_with as $compatible) {
                    $add = new ProjectCompatible();
                    $add->project_id = $project->id;
                    $add->compatible_id = $compatible;
                    $add->save();
                }
            }
            if (isset($features)) {
                foreach ($features as $feature) {
                    if ($feature != '') {
                        $add = new ProjectFeature();
                        $add->project_id = $project->id;
                        $add->feature = $feature;
                        $add->save();
                    }
                }
            }
            foreach ($specials_key as $key => $value) {
                if ($value != '') {
                    $add = new ProjectKeyValue();
                    $add->project_id = $project->id;
                    $add->key = $value;
                    $add->value = $specials_value[$key];
                    $add->save();
                }
            }
            $files = DB::table('files')->where("user_id", Auth::id())->where('project_id', null)->update([
                'project_id' => $project->id,
                'category_id' => $project->category_id,
            ]);
            return response()->json(['success' => true]);
        } else {
            $project = Project::find($id);
            if (!$project) {
                return response()->json(['success' => false, 'message' => 'Project Not Found'], 404);
            }
            $project->name = $title;
            $project->slug = Str::slug($title, '-');
            $project->category_id = $first_category;
            $project->description = $description;
            $project->high_resolution = $high_resolution;
            $project->documentation = $documentation;
            $project->columns = $columns;
            $project->price = $price;
            $project->sale_price = $sale_price;
            $project->layout_id = $layout_id;
            $project->demo_url = $demo_url;

            if ($preview_image != '') {
                $project->preview_image = $preview_image;
            }
            if ($file != '') {
                $project->file = $file;
                $project->originalFile = $originalFile;
                $project->file_name = $originalNameFile;
            }
            if ($main_file != '') {
                $originalName = $main_file->getClientOriginalName();
                $main_file = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($main_file->store('public/project-main-files')));
                $project->main_file = $main_file;
                $project->file_name = $originalName;
            }
            $project->save();

            $delete_browser = ProjectBrowser::where('project_id', $id)->delete();
            $delete_tags = ProjectTags::where('project_id', $id)->delete();
            $delete_category = ProjectCategory::where('project_id', $id)->delete();
            $delete_compatible = ProjectCompatible::where('project_id', $id)->delete();
            $delete_feature = ProjectFeature::where('project_id', $id)->delete();
            $delete_specials = ProjectKeyValue::where('project_id', $id)->delete();
            if (isset($browsers)) {
                foreach ($browsers as $browser) {
                    $add = new ProjectBrowser();
                    $add->project_id = $project->id;
                    $add->browser_id = $browser;
                    $add->save();
                }
            }
            if (isset($tags)) {
                foreach ($tags as $tag) {
                    $add = new ProjectTags();
                    $add->project_id = $project->id;
                    $add->name = $tag;
                    $add->save();
                }
            }

            if (isset($other_categories)) {
                foreach ($other_categories as $category) {
                    $add = new ProjectCategory();
                    $add->project_id = $project->id;
                    $add->category_id = $category;
                    $add->save();
                }
            }
            if (isset($compatible_with)) {
                foreach ($compatible_with as $compatible) {
                    $add = new ProjectCompatible();
                    $add->project_id = $project->id;
                    $add->compatible_id = $compatible;
                    $add->save();
                }
            }
            if (isset($features)) {
                foreach ($features as $feature) {
                    if ($feature != '') {
                        $add = new ProjectFeature();
                        $add->project_id = $project->id;
                        $add->feature = $feature;
                        $add->save();
                    }
                }
            }
            foreach ($specials_key as $key => $value) {
                if ($value != '') {
                    $add = new ProjectKeyValue();
                    $add->project_id = $project->id;
                    $add->key = $value;
                    $add->value = $specials_value[$key];
                    $add->save();
                }
            }
            $files = DB::table('files')->where("user_id", Auth::id())->where('project_id', null)->update([
                'project_id' => $project->id,
                'category_id' => $project->category_id,
            ]);
            return response()->json(['success' => true]);
        }
    }

    public function file_upload(Request $request)
    {
        $user = Auth::user();
        $files = $request->file('files');
        $file = '';
        $originalFile = '';
        $file = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($files->store('public/project')));
        if ($files != '') {
            $originalName = $files->getClientOriginalName();
            $mimeType = $files->getMimeType();
            $hajmafile = '';
            if ($mimeType == 'image/jpeg' || $mimeType == 'image/png') {
                $hajmafile = str_replace('public', 'storage', $files->store('public/project'));
            }
            $image = '';
            if ($mimeType == 'image/jpeg') {
                $image = imagecreatefromjpeg($hajmafile);
            } elseif ($mimeType == 'image/png') {
                $image = imagecreatefrompng($hajmafile);
            }
            $type = explode('/', $mimeType)[0];
            $time = time();
            if ($type == 'audio') {
                $audio_name = str_replace('public', 'storage', $files->store('public/audio'));
                $newName = public_path() . '/storage/sound-track/' . $time . '.mp3';
                // $command = 'ffmpeg -i ' . public_path() . '/' . $audio_name . ' -i ' . public_path() . '/hajmalabs.mp3 -filter_complex amix=inputs=2:duration=longest ' . $newName;
                $command = 'ffmpeg -i ' . public_path() . '/' . $audio_name . ' -filter_complex "amovie=' . public_path() . '/hajmalabs.mp3:loop=999[s];[0][s]amix=duration=shortest" ' . $newName;
                exec($command);

                $originalFile = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($audio_name));
                $file = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset('/storage/sound-track/' . $time . '.mp3'));
            }
            if ($type == 'video') {
                $video_name = str_replace('public', 'storage', $files->store('public/video'));

                $newName = public_path() . '/storage/video-track/' . $time . '.mp4';

                $command = 'ffmpeg -i ' . public_path() . '/' . $video_name . ' -i ' . public_path() . '/hajmalabs.mp3 -codec:v copy -codec:a aac -b:a 192k -strict experimental -ac 2 -shortest ' . $newName;
                exec($command);

                $originalFile = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($video_name));
                $file = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset('/storage/video-track/' . $time . '.mp4'));
            }
            if ($image != '') {
                $file = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($files->store('public/project')));
                $image_width = imagesx($image);
                $image_height = imagesy($image);
                $stamp = imagecreatefrompng('text.png');
                $stamp = imagescale($stamp, $image_width / 5);
                $marge_right = 50;
                $marge_bottom = 50;
                $sx = imagesx($stamp);
                $sy = imagesy($stamp);
                imagecopy(
                    $image,
                    $stamp,
                    $image_width - $sx - $marge_right,
                    $image_height - $sy - $marge_bottom,
                    0,
                    0,
                    $sx,
                    $sy
                );
                header('Content-type: image/png');
                imagepng($image, $hajmafile);
                imagedestroy($image);
            }

            $size = round($files->getSize() * 0.0009765625, 2);
            $mb = 0;
            $gb = 0;
            if ($size < 1024) {
                $size = $size . ' KB';
            } else if ($size > 1024) {
                $mb = round(($size / 1024), 2);
                $size = $mb . ' MB';
            } else if ($mb > 1024) {
                $gb = round(($size / 1024 / 1024), 2);
                $size = $gb . ' GB';
            }
            $file_add = new Files();
            $file_add->file = $file;
            $file_add->mime_type = $mimeType;
            $file_add->size = $size;
            $file_add->original_name = $originalName;
            $file_add->original_file = $originalFile;
            $file_add->user_id = $user->id;
            $file_add->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function file_category(Request $request)
    {
        $id = $request->id;
        $project_id = $request->project_id;
        $has_category = Category::find($id);
        if (!$has_category) {
            return response()->json(['success' => false, 'message' => "Category not found"]);
        }

        $other_categories = Category::where('parent_id', $id)->orWhere('sub_id', $id)->get();
        $other_categories_project = ProjectCategory::where('project_id', $project_id)->get();
        return response()->json(['success' => true, 'other_categories' => $other_categories, 'other_categories_project' => $other_categories_project]);
    }

    public function file_select(Request $request)
    {
        $id = (int)$request->id;
        $user_id = Auth::id();
        if ($id) {
            $project = Project::find($id);
            $user_id = $project->user_id;
        }

        if ($id > 0) {
            $files = DB::table('files')
                ->select('id', 'original_name', 'created_at')
                ->where('mime_type', '!=', 'application/x-rar')
                ->where('mime_type', '!=', 'application/zip')
                ->where('mime_type', '!=', 'audio/mpeg')
                ->where('mime_type', '!=', 'video/mp4')
                ->where('user_id', $user_id)
                ->get();
        } else {
            $files = DB::table('files')
                ->select('id', 'original_name', 'created_at')
                ->where('mime_type', '!=', 'application/x-rar')
                ->where('mime_type', '!=', 'application/zip')
                ->where('mime_type', '!=', 'audio/mpeg')
                ->where('mime_type', '!=', 'video/mp4')
                ->where('project_id', null)
                ->where('category_id', null)
                ->where('user_id', $user_id)
                ->get();
        }
        return response()->json(['success' => true, 'files' => $files]);
    }

    public function preview_file_select(Request $request)
    {
        $id = (int)$request->id;
        $user_id = Auth::id();
        if ($id) {
            $project = Project::find($id);
            $user_id = $project->user_id;
        }

        if ($id > 0) {
            $files = DB::table('files')
                ->select('id', 'original_name', 'created_at')
                ->where('mime_type', '!=', 'application/x-rar')
                ->where('mime_type', '!=', 'application/zip')
                ->where('mime_type', '!=', 'image/png')
                ->where('mime_type', '!=', 'image/jpeg')
                ->where('user_id', $user_id)
                ->get();
        } else {
            $files = DB::table('files')
                ->select('id', 'original_name', 'created_at')
                ->where('project_id', null)
                ->where('category_id', null)
                ->where('user_id', $user_id)
                ->where('mime_type', '!=', 'application/x-rar')
                ->where('mime_type', '!=', 'application/zip')
                ->where('mime_type', '!=', 'image/png')
                ->where('mime_type', '!=', 'image/jpeg')
                ->get();
        }
        return response()->json(['success' => true, 'files' => $files]);
    }

    public function main_file_select(Request $request)
    {
        $id = (int)$request->id;
        $user_id = Auth::id();
        if ($id) {
            $project = Project::find($id);
            $user_id = $project->user_id;
        }
        if ($id > 0) {
            $files = DB::table('files')
                ->select('id', 'original_name', 'created_at')
                ->where('mime_type', '!=', 'audio/mpeg')
                ->where('mime_type', '!=', 'video/mp4')
                ->where('mime_type', '!=', 'image/jpeg')
                ->where('mime_type', '!=', 'image/png')
                ->where('user_id', $user_id)->get();
        } else {
            $files = DB::table('files')
                ->select('id', 'original_name', 'created_at')
                ->where('mime_type', '!=', 'audio/mpeg')
                ->where('mime_type', '!=', 'video/mp4')
                ->where('mime_type', '!=', 'image/jpeg')
                ->where('mime_type', '!=', 'image/png')
                ->where('project_id', null)
                ->where('user_id', $user_id)->get();
        }
        return response()->json(['success' => true, 'files' => $files]);
    }

    public function file_delete(Request $request)
    {
        $id = (int)$request->id;
        $file = Files::where('id', $id)->first();
        if (!$file) {
            return response()->json(['success' => false, 'message' => 'File not found '], 404);
        } else {
            $file->delete();
            return response()->json(['success' => true]);
        }
    }

    public function feature_delete(Request $request)
    {
        $id = $request->id;
        $feature = projectFeature::where('id', $id)->first();

        if (!$feature) {
            return response()->json(['success' => false, 'message' => 'Feature not found '], 404);
        } else {
            $feature->delete();
            return response()->json(['success' => true]);
        }
    }

    public function file_edit($id)
    {
        $categories = Category::where('parent_id', 0)->get();
        $browsers = Browser::all();
        $compatibles = Compatible::all();
        $layouts = Layout::all();

        $files = Files::where('project_id', $id)->where('user_id', Auth::id())->get();
        $project_browsers = ProjectBrowser::where('project_id', $id)->get();
        $other_categories = ProjectCategory::where('project_id', $id)->get();
        $project_compatibles = ProjectCompatible::where('project_id', $id)->get();
        $project_features = ProjectFeature::where('project_id', $id)->get();
        $project_specials = ProjectKeyValue::where('project_id', $id)->get();
        $project_tags = ProjectTags::where('project_id', $id)->get();
        $tags = '';
        foreach ($project_tags as $key => $value) {
            if ($key == 0) {
                $tags .= $value->name;
            } else {
                $tags .= ',' . $value->name;
            }
        }
        $project = Project::where('id', $id)->first();

        if (!$project) {
            abort(404);
        }
        return view('dashboard.file.edit', compact('id', 'categories', 'files', 'compatibles', 'project_browsers', 'other_categories', 'project_compatibles', 'project_features', 'tags', 'layouts', 'browsers', 'project', 'project_specials'));
    }

    public function project_action(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        if ($action == 'confirm') {
            $project = Project::find($id);
            $category_name = $request->category_name;
            $project->submit = 1;
            $project->category_name = $category_name;
            $project->save();
            return response()->json(['success' => true, 'confirm' => true]);
        } else if ($action == 'delete') {
            DB::table('projects')->where('id', $id)->delete();
            DB::table('my_orders')->where('project_id', $id)->delete();
            DB::table('project_categories')->where('project_id', $id)->delete();
            DB::table('project_browsers')->where('project_id', $id)->delete();
            DB::table('project_tags')->where('project_id', $id)->delete();
            return response()->json(['success' => true, 'delete' => true]);
        } else if ($action == 'nothidden') {
            DB::table('projects')->where('id', $id)->update([
                'deleted_at' => null
            ]);
            return response()->json(['success' => true, 'nothidden' => true]);
        }
    }

    public function preview_image_show(Request $request)
    {
        $id = $request->id;
        $file = Files::find($id);

        return response()->json(['success' => true, 'file' => $file]);
    }

    public function preview_image(Request $request)
    {
        $id = $request->id;
        $image = Files::find($id)->file;
        return response()->json(['success' => true, 'image' => $image]);
    }

    public function preview_file(Request $request)
    {
        $id = $request->id;
        $file = Files::find($id);

        return response()->json(['success' => true, 'file' => $file->file, 'type' => $file->mime_type]);
    }

    public function upload_image(Request $request)
    {
        $user_id = Auth::id();
        $image = $request->image;
        $type = $request->type;
        if ($image) {
            $data = substr($image, strpos($image, ',') + 1);
            $data = base64_decode($data);
            $imageName = Str::random(32) . '.' . $type;
            $image_name = 'public/project/' . $imageName;
            Storage::disk('local')->put($image_name, $data);
            $project_image = str_replace(['public', 'http:'], ['storage', App::environment() == 'production' ? 'https:' : 'http:'], asset($image_name));

            $hajmafile = '';

            $hajmafile = str_replace('public', 'storage', $image_name);
            $cretaImage = '';
            if ($type == "jpeg") {
                $cretaImage = imagecreatefromjpeg($hajmafile);
            } elseif ($type == "png") {
                $cretaImage = imagecreatefrompng($hajmafile);
            }
            if ($cretaImage != '') {
                $image_width = imagesx($cretaImage);
                $image_height = imagesy($cretaImage);
                $stamp = imagecreatefrompng('text3.png');
                $stamp = imagescale($stamp, $image_width / 1.5);
                $sx = imagesx($stamp);
                $sy = imagesy($stamp);
                imagecopy(
                    $cretaImage,
                    $stamp,
                    ($image_width / 2) - ($sx / 2),
                    ($image_height / 2) - ($sy / 2),
                    0,
                    0,
                    $sx,
                    $sy
                );
                header('Content-type: image/png');
                imagepng($cretaImage, $hajmafile);
                imagedestroy($cretaImage);
            }
            $file_add = new Files();
            $file_add->file = $project_image;
            $file_add->mime_type = $type;
            $file_add->size = '';
            $file_add->original_name = $imageName;
            $file_add->user_id = $user_id;
            $file_add->save();
            return response()->json(['success' => true, 'id' => $file_add->id]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function download($id)
    {
        $project = Project::find($id);

        $type = Category::where('id' , $project->category_id)->first()->type;
        $url = "";
        if($type == "icon")
        {
            $url = Files::where('project_id' , $id)->first()->file;
        }
        else{
            $url = $project->originalFile ?? $project->main_file;
        }

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );


        $get_content = file_get_contents($url, false, stream_context_create($arrContextOptions));
        $name = substr($url, strrpos($url, '/') + 1);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($get_content));
        print $get_content;
        exit();

        // return \response()->download('/home/admin/web/hajmalabs.com/public_html/theme/storage/app/public'. explode('storage', $url)[1]);

    }
}
