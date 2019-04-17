<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $path = $request['params']['file'];
        $filename = basename($path);

        $myFile = \Image::make($path);
        //$url = Storage::url($store);
        return "done";
    }
}
