<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $timestamps = false;

    const ITEMS = [
        'epic fantasy', 'science fiction', 'comedy', 'action', 'horror', 'romance', 'mistery', 'drama',
        'crime'
    ];

    protected $fillable = [
        'name'
    ];




}
