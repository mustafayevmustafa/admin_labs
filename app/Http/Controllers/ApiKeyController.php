<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        $apikeys = ApiKey::all();
        return view('apikey.apikey', compact('apikeys'));
    }

    public function add_edit_apikey(Request $request)
    {
        $id = $request->id;
        $key_name = $request->key_name;
        $key = $request->key;

        if ($id == 0) {
            $has_apikey = ApiKey::where('key_name', $key_name)->first();
            if ($has_apikey) {
                return response()->json(['succes' => false, 'errors' => "apikey exists"], 400);
            }
            $add = new ApiKey();
            $add->key_name = $key_name;
            $add->key = $key;
            $add->save();
        } else {
            $edit = ApiKey::find($id);
            $edit->key_name = $key_name;
            $edit->key = $key;
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_apikey(Request $request)
    {
        $id = $request->id;
        $apikey = ApiKey::find($id);
        return response()->json(['success' => true, 'apikey' => $apikey]);
    }
    public function delete_apikey(Request $request)
    {
        $id = $request->id;
        ApiKey::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
