<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        $layouts = Layout::all();
        return view('layout.layouts', compact('layouts'));
    }

    public function add_edit_layout(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        if ($id == 0) {
            $has_layout = Layout::where('name', $name)->first();
            if ($has_layout) {
                return response()->json(['succes' => false, 'errors' => "Layout exists"], 400);
            }
            $add = new Layout();
            $add->name = $name;
            $add->save();
        } else {
            $edit = Layout::find($id);
            $edit->name = $name;
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_layout(Request $request)
    {
        $id = $request->id;
        $layout = Layout::find($id);
        return response()->json(['success' => true, 'layout' => $layout]);
    }
    public function delete_layout(Request $request)
    {
        $id = $request->id;
        Layout::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
