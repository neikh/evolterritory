<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlowController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'getNew', 'getHot']]);
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
                ->join('votes', 'id_voteur', '=',  Auth::id())
                ->take(10)
                ->offset($page)
                ->get();

        return $newPosts;
    }

    public function getHot($page = 0)
    {
        //récupérer les 10 derniers post par nombre de vote
        $hotPosts = \App\Post::orderBy('sun_vote', 'desc')
                ->join('votes', 'id_voteur', '=',  Auth::id())
                ->take(10)
                ->offset($page)
                ->get();

        return $hotPosts;
    }

    public function vote(Request $request){

        $vote = \App\Vote::updateOrCreate(
            [ 'id_voteur' => Auth::id(), 'id_post' => $request['params']['id'] ],
            ['sun' => $request['params']['sun'], 'cloud' => $request['params']['cloud'] ]
        );

        $sun_votes = \App\Vote::where('sun', '=', true)->count();
        $cloud_votes = \App\Vote::where('cloud', '=', true)->count();

        $post = \App\Post::where('id', $request['params']['id'])
            ->update([
                'sun_vote' =>  $sun_votes,
                'cloud_vote' =>  $cloud_votes,
            ]);

        return ([$sun_votes,  $cloud_votes]);
    }

}
