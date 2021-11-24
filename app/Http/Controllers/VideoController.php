<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index()
    {
        $videos = Videos::all();
        return view('videos.videos', compact('videos'));
    }

    public function add_edit_video(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        if ($id == 0) {
            $has_video = Videos::where('name', $name)->first();
            if ($has_video) {
                return response()->json(['succes' => false, 'errors' => "Video Plugins exists"], 400);
            }
            $add = new Videos();
            $add->name = $name;
            $add->save();
        } else {
            $edit = Videos::find($id);
            $edit->name = $name;
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_video(Request $request)
    {
        $id = $request->id;
        $video = Videos::find($id);
        return response()->json(['success' => true, 'video' => $video]);
    }
    public function delete_video(Request $request)
    {
        $id = $request->id;
        Videos::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
