<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select(
            "id",
            'name',
            'type',
            'parent_id',
            DB::raw("(SELECT name FROM categories as parent WHERE parent.id = categories.parent_id) as parent")
        )->orderBy('id', 'ASC')
            ->get();
        $select_categories = Category::select(
            "id",
            'name',
        )->where('type', '!=', null)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('category.categories', compact('categories', 'select_categories'));
    }


    // Post Methods


    public function add_edit_category(Request $request)
    {
        $id = $request->id;
        $parent_id = $request->parent_id;
        $name = $request->name;
        $type = $request->type;
        if ($id == 0) {
            $has_category = Category::where('name', $name)->first();
            $has_category_sub = Category::where('id', $parent_id)->first();
//            if ($has_category) {
//                return response()->json(['succes' => false, 'errors' => "Category exists"], 400);
//            }
            $add = new Category();
            $add->name = $name;
            $add->slug = Str::slug($name, '-');
            $add->type = $type;
            $add->parent_id = $parent_id;
            if ($parent_id != 0) {
                $add->sub_id = $has_category_sub->parent_id;
            }
            $add->save();
        } else {
            $edit = Category::find($id);
            $edit->name = $name;
            $edit->type = $type;
            $edit->slug = Str::slug($name, '-');
            $edit->parent_id = $parent_id;
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_category(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        return response()->json(['success' => true, 'category' => $category]);
    }
    public function delete_category(Request $request)
    {
        $id = $request->id;
        Category::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
