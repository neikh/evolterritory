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
                    ->leftJoin('votes', function($join){
                        $join->on('id_voteur', '=', Auth::id());
                        $join->on('posts.id', '=', 'votes.id_post');
                    })
                    ->take(10)
                    ->offset($page)
                    ->get([
                        'posts.id as id',
                        'posts.id_author as id_author',
                        'posts.id_pic_1 as id_pic_1',
                        'posts.id_pic_2 as id_pic_2',
                        'posts.date1 as date1',
                        'posts.date2 as date2',
                        'posts.titre as titre',
                        'posts.description as description',
                        'posts.sun_vote as sun_vote',
                        'posts.cloud_vote as cloud_vote',
                        'votes.sun as sun',
                        'votes.cloud as cloud'
                    ]);

        return $newPosts;
    }

    public function getHot($page = 0)
    {
        //récupérer les 10 derniers post par nombre de vote
        $hotPosts = \App\Post::orderBy('posts.sun_vote', 'desc')
                ->leftJoin('votes', function($join){
                    $join->on('id_voteur', '=', Auth::id());
                    $join->on('posts.id', '=', 'votes.id_post');
                })
                ->take(10)
                ->offset($page)
                ->get([
                    'posts.id as id',
                    'posts.id_author as id_author',
                    'posts.id_pic_1 as id_pic_1',
                    'posts.id_pic_2 as id_pic_2',
                    'posts.date1 as date1',
                    'posts.date2 as date2',
                    'posts.titre as titre',
                    'posts.description as description',
                    'posts.sun_vote as sun_vote',
                    'posts.cloud_vote as cloud_vote',
                    'votes.sun as sun',
                    'votes.cloud as cloud'
                ]);

        return $hotPosts;
    }

    public function vote(Request $request){

        $vote = \App\Vote::updateOrCreate(
            [ 'id_voteur' => Auth::id(), 'id_post' => $request['params']['id'] ],
            [ 'sun' => $request['params']['sun'], 'cloud' => $request['params']['cloud'] ]
        );

        $sun_votes = \App\Vote::where('sun', '=', true)->where('id_post', '=', $request['params']['id'])->count();
        $cloud_votes = \App\Vote::where('cloud', '=', true)->where('id_post', '=', $request['params']['id'])->count();

        $post = \App\Post::where('id', $request['params']['id'])
            ->update([
                'sun_vote' =>  $sun_votes,
                'cloud_vote' =>  $cloud_votes
            ]);

        return ([$sun_votes,  $cloud_votes]);
    }

}
