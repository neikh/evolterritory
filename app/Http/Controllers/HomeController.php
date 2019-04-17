<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

        return view('home');

    }

    public function getPic()
    {

        //on va récupérer toutes les images dans le dossier storage/app/public/random
        //randomPictures est un driver crée dans config/filesystems.php qui renvoie sur le bon répertoire
        $files = \Storage::disk('randomPictures')->files();

        //On choisi une image random dans le dossier
        $pic = mt_rand(0, count($files)-1);

        return 'storage/random/'.$files[$pic];

    }
}
