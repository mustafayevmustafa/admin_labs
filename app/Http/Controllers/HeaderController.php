<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HeaderController extends Controller
{
    public function index()
    {
        $header = Header::first();
        return view('header.header', compact('header'));
    }

    public function add_edit_header(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $text = $request->text;
        $image = $request->file('image');
        if ($image != null) {
            $image = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($image->store('public/project')));
        }
        if ($id == 0) {
            $this->validate($request, [
                'title' => 'required',
                'text' => 'required',
                'image' => 'required',
            ]);

            $add = new Header();
            $add->title = $title;
            $add->text = $text;
            $add->image = $image;
            $add->save();
        } else {
            if ($image != null) {
                $edit = Header::find($id);
                $edit->title = $title;
                $edit->text = $text;
                $edit->image = $image;
                $edit->save();
            } else {
                $edit = Header::find($id);
                $edit->title = $title;
                $edit->text = $text;
                $edit->save();
            }
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_header(Request $request)
    {
        $id = $request->id;
        $header = Header::find($id);
        return response()->json(['success' => true, 'header' => $header]);
    }
    public function delete_header(Request $request)
    {
        $id = $request->id;
        Header::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
