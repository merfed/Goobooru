<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class Users extends Controller
{
    public function profile(User $id)
    {
        return view('profile', ['user' => $id]);
    }
}
