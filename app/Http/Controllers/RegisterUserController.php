<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterUserController extends Controller
{
    public function index()
    {
        $update = DB::table('users')->where("submit", 0)->update(['submit' => 1]);
        $users = User::orderBy('id', "DESC")->get();
        return view('register.register', compact('users'));
    }
    public function delete_user(Request $request)
    {
        $id = $request->id;
        User::find($id)->delete();

        return response()->json(['success' => true]);
    }
}
