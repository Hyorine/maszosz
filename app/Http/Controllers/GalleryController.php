<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function showGallery()
    {
        $galleryPath = public_path('gallery');
        $images = File::files($galleryPath);

        return view('main', ['images' => $images])->with('modul','galery');
    }
    public function handler()
    {

    }
}
