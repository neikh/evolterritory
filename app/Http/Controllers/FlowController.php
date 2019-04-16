<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlowController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //récupérer les 10 derniers post par nombre de vote
        $hotPosts = \App\Post::orderBy('nb_vote', 'desc')
               ->take(10)
               ->get();

        //récupérer les 10 derniers post par date
        $newPosts = \App\Post::orderBy('created_at', 'desc')
               ->take(10)
               ->get();

        return view('flow', array(
			'hotPosts' => $hotPosts,
			'newPosts' => $newPosts
		));
    }
}
