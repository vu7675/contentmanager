<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function categories(){
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }
}
