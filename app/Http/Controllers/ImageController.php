<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        if (isset($request['params']['file'])){
            $path = $request['params']['file'];
            $filename = basename($path);

            $myFile = \Image::make($path);
            //$url = Storage::url($store);
            return "done";
        } else {
            $path = $request['params']['file1'];
            $filename = basename($path);

            $myPic = \Image::make($path)->resize(150, 100)->save(base_path('storage/app/public/images/'.$filename));

        }
    }
}
