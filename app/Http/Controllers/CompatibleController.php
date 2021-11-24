<?php

namespace App\Http\Controllers;

use App\Models\Compatible;
use Illuminate\Http\Request;

class CompatibleController extends Controller
{
    public function index()
    {
        $compatibles = Compatible::all();
        return view('compatible.compatibles', compact('compatibles'));
    }

    public function add_edit_compatible(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        if ($id == 0) {
            $has_compatible = Compatible::where('name', $name)->first();
            if ($has_compatible) {
                return response()->json(['succes' => false, 'errors' => "Compatible exists"], 400);
            }
            $add = new Compatible();
            $add->name = $name;
            $add->save();
        } else {
            $edit = Compatible::find($id);
            $edit->name = $name;
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_compatible(Request $request)
    {
        $id = $request->id;
        $compatible = Compatible::find($id);
        return response()->json(['success' => true, 'compatible' => $compatible]);
    }
    public function delete_compatible(Request $request)
    {
        $id = $request->id;
        Compatible::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
