<?php

namespace App\Http\Controllers;

use App\Models\PotensiDesa;
use Illuminate\Http\Request;

class PotensiDesaController extends Controller
{
    public function index()
    {

        $potensiDesa = PotensiDesa::all();
        $officials = \App\Models\VillageOfficial::orderBy('order', 'asc')->get();

        return view('pages.profildesa', compact('potensiDesa', 'officials'));
    }
}
