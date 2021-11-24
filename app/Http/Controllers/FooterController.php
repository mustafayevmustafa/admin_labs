<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::first();
        return view('footer.footer', compact('footer'));
    }

    public function add_edit_footer(Request $request)
    {
        $id = $request->id;
        $content = $request->content;

        if ($id == 0) {
            $has_footer = Footer::where('content', $content)->first();
            if ($has_footer) {
                return response()->json(['succes' => false, 'errors' => "Footer content exists"], 400);
            }
            $add = new Footer();
            $add->content = $content;
            $add->save();
        } else {
            $edit = Footer::find($id);
            $edit->content = $content;
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_footer(Request $request)
    {
        $id = $request->id;
        $footer = Footer::find($id);
        return response()->json(['success' => true, 'footer' => $footer]);
    }
    public function delete_footer(Request $request)
    {
        $id = $request->id;
        Footer::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
