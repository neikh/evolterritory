<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;

class ImageController extends Controller
{
    public function store(ImageRequest $request)
    {
        if (isset($request['params']['file'])){
            $path = $request['params']['file'];
            $filename = basename($path);

            $myFile = \Image::make($path);
            //$url = Storage::url($store);
            return "done";
        }
    }
}
