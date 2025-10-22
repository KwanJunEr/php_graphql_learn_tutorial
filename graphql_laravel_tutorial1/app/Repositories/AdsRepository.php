<?php

namespace App\Repositories;

use App\Models\Ads;

class AdsRepository
{
    public function create(array $data)
    {
        return Ads::create($data);
    }

    public function getAll()
    {
        return Ads::all();
    }
}
