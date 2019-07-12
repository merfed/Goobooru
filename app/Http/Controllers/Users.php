<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class Users extends Controller
{
    public function profile(User $id)
    {
        return view('profile', ['user' => $id]);
    }

    public function settings()
    {
        return view('user.settings');
    }

    public function uploadAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required',
        ]);

        $image = $request->file('avatar');
        $name = str_random(32) .'.'. $image->getClientOriginalExtension();
        $image->move(public_path(config('goobooru.avatar_upload_path')), $name);

        Auth::user()->avatar = $name;
        Auth::user()->save();

        return redirect()->back()->with('success', 'Your avatar has been set!');
    }
}
