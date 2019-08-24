<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Like;
use App\Dislike;

class DislikeController extends Controller
{
    public function dislikeMovie(Request $request){

        $user = $request->user();
        $user_id = $user['id'];
        $movie_id = $request['movie_id'];

        if (
            !(Dislike::where('movie_id', $movie_id)->where('user_id', $user_id)->get())->isEmpty() || 
            !(Like::where('movie_id', $movie_id)->where('user_id', $user_id)->get())->isEmpty()
        )   {
            return "User has already liked or disliked the movie";
            }
            
        $dislike = Dislike::create([
            'user_id' => $user_id,
            'movie_id' => $movie_id
        ]);

        Movie::where('id', $movie_id)->increment('dislikes', 1);

        $movie = (Movie::with(['userLiked' => function($query) use ($user_id){
            $query->where('user_id', $user_id);
        }])->with(['userDisliked' => function($query) use ($user_id){
            $query->where('user_id', $user_id);
        }])->with(['inUsersWatchlist' => function($query) use ($user_id){
            $query->where('user_id', $user_id);
        }]))->find($movie_id)->load('genre');

        return $movie;
    }
}