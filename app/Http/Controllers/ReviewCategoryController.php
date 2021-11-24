<?php

namespace App\Http\Controllers;

use App\Models\ReviewCategory;
use Illuminate\Http\Request;

class ReviewCategoryController extends Controller
{
    public function index()
    {
        $review_categories = ReviewCategory::all();
        return view('review_category.review_categories', compact('review_categories'));
    }

    public function add_edit_review_category(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $has_review_category = ReviewCategory::where('name', $name)->first();
        if ($has_review_category) {
            return response()->json(['succes' => false, 'errors' => "Review category exists"], 400);
        }
        if ($id == 0) {

            $add = new ReviewCategory();
            $add->name = $name;
            $add->save();
        } else {
            $edit = ReviewCategory::find($id);
            $edit->name = $name;
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_review_category(Request $request)
    {
        $id = $request->id;
        $review_category = ReviewCategory::find($id);
        return response()->json(['success' => true, 'review_category' => $review_category]);
    }
    public function delete_review_category(Request $request)
    {
        $id = $request->id;
        ReviewCategory::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
