<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function post_image()
    {
        return $this->hasMany(PostImage::class);
    }
}
