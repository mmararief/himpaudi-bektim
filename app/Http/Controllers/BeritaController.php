<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    /**
     * Public list of published news
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $items = Berita::published()
            ->withCount('comments')
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
        $berita = Berita::published()->where('slug', $slug)->with(['user', 'photos', 'comments.user.dataPribadi'])->firstOrFail();

        // Increment views
        $berita->incrementViews();

        return view('berita.show', compact('berita'));
    }

    /**
     * Store a comment on berita
     */
    public function storeComment(Request $request, string $slug)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $berita = Berita::published()->where('slug', $slug)->firstOrFail();

        $berita->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
