<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Public list of published news
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $items = Berita::published()
            ->when($q, fn($qBuilder) => $qBuilder->where('judul', 'like', "%{$q}%"))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('berita.index', compact('items', 'q'));
    }

    /**
     * Show a single news by slug
     */
    public function show(string $slug)
    {
        $berita = Berita::published()->where('slug', $slug)->with('user')->firstOrFail();
        return view('berita.show', compact('berita'));
    }
}
