<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Affiche la page post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('post');
    }


    /**
     * Enregistre le post dans la bdd.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(ImageRequest $request)
    {

        $random = \Str::random(40);
        \Image::make($request['params']['file1'])->resize(512, 512)->save(base_path('storage/app/public/images/'.$random.'.jpg'));
        $random2 = \Str::random(40);
        \Image::make($request['params']['file2'])->resize(512, 512)->save(base_path('storage/app/public/images/'.$random2.'.jpg'));

        $post = new \App\Post;
        $post->id_author = Auth::id();
        $post->id_pic_1 = 'images/'.$random.'.jpg';
        $post->id_pic_2 = 'images/'.$random2.'.jpg';
        $post->date1 = $request['params']['date1'];
        $post->date2 = $request['params']['date2'];
        $post->titre = $request['params']['titre'];
        $post->description = $request['params']['description'];
        $post->sun_vote = 0;
        $post->cloud_vote = 0;
        $post->save();

        return Auth::id();
    }
}
