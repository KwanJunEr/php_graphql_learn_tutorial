<?php
namespace App\GraphQL\Queries;

use App\Repositories\AdsRepository;

class AdsQuery
{
    public function get_all()
    {
        return (new AdsRepository())->getAll();
    }
}