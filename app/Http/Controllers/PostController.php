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
        //Linux
        \Image::make($request['params']['file1'])->resize(512, 512)->save(base_path('storage/app/public/images/'.$random.'.jpg'));
        //Windows
        // \Image::make($request['params']['file1'])->resize(512, 512)->save(base_path('storage\app\public\images\\'.$random.'.jpg'));
        $random2 = \Str::random(40);
        //Linux

        \Image::make($request['params']['file2'])->resize(512, 512)->save(base_path('storage/app/public/images/'.$random2.'.jpg'));
        //Windows
        // \Image::make($request['params']['file2'])->resize(512, 512)->save(base_path('storage\app\public\images\\'.$random2.'.jpg'));

        $post = new \App\Post;
        $post->id_author = Auth::id();
        //Linux
        $post->id_pic_1 = 'images/'.$random.'.jpg';
        $post->id_pic_2 = 'images/'.$random2.'.jpg';
        //Windows
        // $post->id_pic_1 = 'images\\'.$random.'.jpg';
        // $post->id_pic_2 = 'images\\'.$random2.'.jpg';
        $post->titre = $request['params']['titre'];
        $post->description = $request['params']['description'];
        $post->nb_vote = 0;
        $post->save();

        return Auth::id();
    }
}
