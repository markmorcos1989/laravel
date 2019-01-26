<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $guarded=[];
    
    public function posts()
    {
        return $this->belongsToMany(post::class, 'tag_post');
    }
}
