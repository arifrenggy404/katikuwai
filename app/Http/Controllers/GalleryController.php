<?php

namespace App\Http\Controllers;

use App\Models\GalleryAlbum;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::with('photos')->latest()->get();
        return view('pages.gallery', compact('albums'));
    }
}
