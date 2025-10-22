<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    protected $repo;

    public function __construct(PostRepository $repo)
    {
        $this->repo = $repo;
    }

    // Change this method to accept any Request
    public function create(Request $request)
    {
        // Validate manually if it's not a PostRequest
        if (!$request instanceof PostRequest) {
            $validated = $request->validate([
                'user_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);
        } else {
            $validated = $request->validated();
        }

        return $this->repo->create($validated);
    }
}