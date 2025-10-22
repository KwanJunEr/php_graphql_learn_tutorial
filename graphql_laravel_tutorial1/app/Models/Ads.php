<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    //
    protected $fillable = [
        'user_id', 'ads_title', 'ads_slug', 'ads_description',
        'ads_price', 'ads_discount', 'is_discount'
    ];
}
