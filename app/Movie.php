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
    
    public function inUsersWatchlist()
    {
        return $this->hasMany('App\Watchlist');
    }
}
