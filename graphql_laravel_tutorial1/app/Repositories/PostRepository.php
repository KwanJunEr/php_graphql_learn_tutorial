<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function create(array $data)
    {
        return Post::create($data);
    }

    public function getAll()
    {
        return Post::all();
    }
}