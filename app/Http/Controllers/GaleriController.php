<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest('tanggal_kegiatan')->paginate(12);
        return view('galeri.index', compact('galeris'));
    }

    public function show(Galeri $galeri)
    {
        return view('galeri.show', compact('galeri'));
    }
}
