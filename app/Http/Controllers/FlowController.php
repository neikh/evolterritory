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
        return view('flow');
    }

    public function getNew($page = 0)
    {
        //récupérer les 10 derniers post par date
        $newPosts = \App\Post::orderBy('id', 'desc')
               ->take(10)
               ->offset($page)
               ->get();

        return $newPosts;
    }

    public function getHot($page = 0)
    {
        //récupérer les 10 derniers post par nombre de vote
        $hotPosts = \App\Post::orderBy('nb_vote', 'desc')
               ->take(10)
               ->get();

        return $hotPosts;
    }
}
