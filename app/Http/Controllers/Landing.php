<?php

namespace App\Http\Controllers;

use App\Booru;
use Illuminate\Http\Request;

class Landing extends Controller
{
    public function index()
    {
        return view('home', ['count' => Booru::count()]);
    }
}
