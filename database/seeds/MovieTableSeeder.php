<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Genre;

class MovieTableSeeder extends Seeder
{
    public function run()
    {
        foreach(Genre::ITEMS as $genreName) {
            $genre = Genre::firstOrCreate([
                'name' => $genreName
            ]);
            
            factory(Movie::class, 5)->create(['genre_id' => $genre->id]);
        
        }
    }
}
