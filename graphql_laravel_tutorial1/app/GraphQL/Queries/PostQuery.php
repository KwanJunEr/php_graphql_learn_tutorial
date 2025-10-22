<?php
namespace App\GraphQL\Queries;

use App\Repositories\PostRepository;

class PostQuery
{
    public function get_all()
    {
        return (new PostRepository())->getAll();
    }
}
