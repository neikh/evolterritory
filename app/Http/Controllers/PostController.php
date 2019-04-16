<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
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
    public function store()
    {
         return ['vooila','lalala'];
    }
}
