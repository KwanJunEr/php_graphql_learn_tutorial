<?php
namespace App\GraphQL\Mutations;

use App\Http\Requests\AdsRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class AdsMutator
{
    public function create($_, array $args)
    {
        $request = new Request($args);

        // Call controller
        return app()->call('App\Http\Controllers\AdsController@create', [
            'request' => $request
        ]);
    }
}
