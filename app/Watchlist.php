<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'movie_id', 'watched', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }
}
