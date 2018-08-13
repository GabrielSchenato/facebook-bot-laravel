<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $appends = ['image_full_url'];
    protected $fillable = [
        'title', 'subtitle', 'image_url', 'url'
    ];

    protected function getImageFullUrlAttribute()
    {
        return 'https://s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/products/' . $this->attributes['image_url'];
    }

}
