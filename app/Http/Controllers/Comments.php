<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class Comments extends Controller
{
    public function index()
    {
        return view('comments.index', ['comments' => Comment::latest()->paginate(20)]);
    }
}
