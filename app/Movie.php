<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    
    protected $fillable = [
        'title', 'description', 'image_url', 'genre_id', 'like_id', 'dislike_id',
        'likes', 'dislikes'
    ];

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function userLiked()
    {
        return $this->hasMany('App\Like');
    }

    public function userDisliked()
    {
        return $this->hasMany('App\Dislike');
    }
}
