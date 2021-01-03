<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;

class ImageController extends Controller
{
    public function getImage(Image $image){
        return response()->json($image->load('post'));
    }
}
