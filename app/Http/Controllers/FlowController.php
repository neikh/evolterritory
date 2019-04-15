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
        //récupérer les 10 derniers post par date
        //récupérer les 10 derniers post par nombre de vote
        return view('flow');
    }
}
