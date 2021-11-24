<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::orderBy('id', 'DESC')->get();
        return view('social.social', compact('socials'));
    }

    public function add_edit_social(Request $request)
    {
        $id = $request->id;
        $link = $request->link;
        $icon = $request->icon;
        if ($id == 0) {
            $has_social = Social::where('link', $link)->first();
            if ($has_social) {
                return response()->json(['succes' => false, 'errors' => "social exists"], 400);
            }
            $add = new Social();
            $add->link = $link;
            $add->icon = $icon;
            $add->save();
        } else {
            $edit = Social::find($id);
            $edit->link = $link;
            $edit->icon = $icon;
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_social(Request $request)
    {
        $id = $request->id;
        $social = Social::find($id);
        return response()->json(['success' => true, 'social' => $social]);
    }
    public function delete_social(Request $request)
    {
        $id = $request->id;
        Social::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
