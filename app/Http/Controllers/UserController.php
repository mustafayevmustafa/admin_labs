<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit_profile($username)
    {
        $user = DB::table('users')->select(
            'id',
            "first_name",
            "last_name",
            "username",
            "email",
            "phone_number",
            "address",
            "country",
            "city",
            "postal_code",
            "facebook",
            "instagram",
            "twitter",
            "pinterest",
            "website",
            "about",
            "profile_image",
            DB::raw("CONCAT  (first_name, ' ', last_name) AS full_name")
        )->where('username', $username)->first();
        if (!$user) {
            return abort(404);
        }
        return view('user.edit_profile', compact('user'));
    }
    public function edit_profile_update(Request $request)
    {
        $user_id = $request->user_id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $username = $request->username;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $country = $request->country;
        $postal_code = $request->postal_code;
        $city = $request->city;
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $twitter = $request->twitter;
        $pinterest = $request->pinterest;
        $about = $request->about;
        $profile_image = $request->file('profile_image');


        $user_update = User::find($user_id);
        $user_update->first_name = $first_name;
        $user_update->last_name = $last_name;
        $user_update->username = $username;
        $user_update->email = $email;
        $user_update->phone_number = $phone_number;
        $user_update->address = $address;
        $user_update->country = $country;
        $user_update->postal_code = $postal_code;
        $user_update->city = $city;
        $user_update->facebook = $facebook;
        $user_update->instagram = $instagram;
        $user_update->twitter = $twitter;
        $user_update->pinterest = $pinterest;
        $user_update->about = $about;
        if ($profile_image != '') {
            $image = str_replace(['public', 'http:'], ['storage', App::environment() == 'production' ? 'https:' : 'http:'], asset($profile_image->store('public/profile/')));
            $user_update->profile_image = $image;
        }
        $user_update->save();

        return response()->json(['status' => true]);
    }

    public function password_change()
    {
        return view('auth.password_change');
    }

    public function password_update(Request $request)
    {
        $user_id = Auth::id();
        $password = $request->password;
        $confirmPassword = $request->confirmPassword;

        if ($password == $confirmPassword) {
            $user = User::find($user_id);
            $user->password = Hash::make($password);
            $user->save();
            return response()->json(['success' => true]);
        }
    }
}
