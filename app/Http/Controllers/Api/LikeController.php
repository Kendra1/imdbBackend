<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Like;
use App\Dislike;

class LikeController extends Controller
{
    public function likeMovie(Request $request){

        $user_id = Auth::user()['id'];
        $movie_id = $request['movie_id'];
    
        $like = Like::where('user_id', $user_id)->where('movie_id', $movie_id);
        
        if(!(($like->first()) === null)){
            $like -> delete();
            Movie::where('id', $movie_id)->decrement('likes', 1);
        }
        else{
            $like = Like::create([
                'user_id' => $user_id,
                'movie_id' => $movie_id
            ]);    
            Movie::where('id', $movie_id)->increment('likes', 1);
        }   

        $movie = (Movie::with(['inUsersWatchlist' => function($query) use ($user_id){
            $query->where('user_id', $user_id);
        }]))->find($movie_id)->load('genre');

        return $movie;   
    }
}