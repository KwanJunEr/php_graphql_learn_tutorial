<?php
namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class PostMutator
{
    public function create($_, array $args)
    {
        // Create a Request object with the input data
        $request = new Request($args);

        // Call your controller action
        return App::call('App\Http\Controllers\PostController@create', [
            'request' => $request
        ]);
    }
}
