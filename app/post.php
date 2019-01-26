<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
	use LikableTrait;
	
    protected $guarded = [];

    //protected $fillable=['subject','post','tags','user_id'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function comments()
    {
    	return $this->morphMany(comment::class, 'commentable')->orderByDesc('created_at', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_post');
    }
}
