<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdsRequest;
use App\Repositories\AdsRepository;

class AdsController extends Controller
{
    //

    protected $repo;

    public function __construct(AdsRepository $repo)
    {
        $this->repo = $repo;
    }

      public function create(Request $request)
    {
        // Check if it's a FormRequest (HTTP) or regular Request (GraphQL)
        if (!$request instanceof AdsRequest) {
            // GraphQL: Validate manually
            $validated = $request->validate([
                'user_id' => 'required|integer',
                'ads_title' => 'required|string|max:255',
                'ads_description' => 'required|string',
                'ads_price' => 'required|numeric|min:0',
                'ads_discount' => 'nullable|numeric|min:0',
                'is_discount' => 'required|boolean',
            ]);
        } else {
            // HTTP: Use FormRequest validation
            $validated = $request->validated();
        }

        return $this->repo->create($validated);
    }

}
