<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovieRequest;
use App\Movie;
use App\Like;
use App\Dislike;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $user_id = $user['id'];

        $queryBuilder = Movie::with(['userLiked' => function($query) use ($user_id){
            $query->where('user_id', $user_id);
        }])->with(['userDisliked' => function($query) use ($user_id){
            $query->where('user_id', $user_id);
        }]);

        if ($request['searchParam']){
            $queryBuilder = $queryBuilder->where('title', 'like', '%' . $request['searchParam'] . '%');
        }

        if ($request['genre']){
            $queryBuilder = $queryBuilder->where('genre_id', $request['genre']);
        }
       
        return $queryBuilder->paginate(5);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMovieRequest $request)
    {
        $validated = $request->validated();

        return Movie::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => $validated['image_url'],
            'genre_id' => $validated['genre_id']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user_id = ($request->user())['id'];

        Movie::where('id', $id)->increment('counter', 1);

        $movie = (Movie::with(['userLiked' => function($query) use ($user_id){
            $query->where('user_id', $user_id);
        }])->with(['userDisliked' => function($query) use ($user_id){
            $query->where('user_id', $user_id);
        }]))->find($id)->load('genre');

        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function popularMovies()
    {
        $movies = Movie::orderBy('likes', 'desc')->take(10)->get();

        return $movies;
    }

    public function relatedMovies(Request $request)
    {
        $genre_id = $request->input('genreId');
        
        $movies = Movie::where('genre_id', $genre_id)->take(10)->get();

        return $movies;
    }
}
