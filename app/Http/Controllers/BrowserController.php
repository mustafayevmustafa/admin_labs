<?php

namespace App\Http\Controllers;

use App\Models\Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrowserController extends Controller
{
    public function index()
    {
        $browsers = Browser::all();
        return view('browser.browsers', compact('browsers'));
    }

    public function add_edit_browser(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        if ($id == 0) {
            $has_browser = Browser::where('name', $name)->first();
            if ($has_browser) {
                return response()->json(['succes' => false, 'errors' => "Browser exists"], 400);
            }
            $add = new Browser();
            $add->name = $name;
            $add->slug = Str::slug($name, '-');
            $add->save();
        } else {
            $edit = Browser::find($id);
            $edit->name = $name;
            $edit->slug = Str::slug($name, '-');
            $edit->save();
        }
        return response()->json(['success' => true], 200);
    }
    public function edit_browser(Request $request)
    {
        $id = $request->id;
        $browser = Browser::find($id);
        return response()->json(['success' => true, 'browser' => $browser]);
    }
    public function delete_browser(Request $request)
    {
        $id = $request->id;
        Browser::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
