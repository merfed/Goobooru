<?php

namespace App\Http\Controllers;

use App\Booru;
use Illuminate\Http\Request;

class Landing extends Controller
{
    public function index()
    {
        $count = Booru::count();

        return view('home', [
            'count' => $count,
            'split_count' => str_split($count),
            'rainbow' => config('goobooru.counter_colors')
        ]);
    }
}
