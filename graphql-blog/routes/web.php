<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    $posts = Post::with('comments')->latest()->get();
    return view('posts.index', compact('posts'));
});
