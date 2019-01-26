<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
	use LikableTrait;

    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(user::class);
    }

    public function commentable()
    {
    	return $this->morphTo();
    }

    public function comments()
    {
    	return $this->morphMany(comment::class, 'commentable')->latest();
    }
}
