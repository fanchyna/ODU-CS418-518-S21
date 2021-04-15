<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function summary(Post $post)
    {
        return view('summary');
    }
}
