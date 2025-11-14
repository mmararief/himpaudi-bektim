<?php

namespace App\Http\Controllers;

use App\Models\ForumTopik;
use App\Models\ForumBalasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of forum topics
     */
    public function index()
    {
        $topiks = ForumTopik::with(['user', 'balasan'])
            ->withCount('balasan')
            ->orderBy('is_pinned', 'desc')
            ->latest()
            ->paginate(15);

        return view('forum.index', compact('topiks'));
    }

    /**
     * Show the form for creating a new topic
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created topic
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string|min:10',
        ]);

        $topik = ForumTopik::create([
            'user_id' => Auth::id(),
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
        ]);

        return redirect()->route('forum.show', $topik->slug)
            ->with('success', 'Topik forum berhasil dibuat!');
    }

    /**
     * Display the specified topic
     */
    public function show($slug)
    {
        $topik = ForumTopik::where('slug', $slug)
            ->with(['user', 'balasan.user'])
            ->firstOrFail();

        // Increment views
        $topik->incrementViews();

        return view('forum.show', compact('topik'));
    }

    /**
     * Show the form for editing the specified topic
     */
    public function edit($slug)
    {
        $topik = ForumTopik::where('slug', $slug)->firstOrFail();

        // Only the author or admin can edit
        if ($topik->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit topik ini.');
        }

        return view('forum.edit', compact('topik'));
    }

    /**
     * Update the specified topic
     */
    public function update(Request $request, $slug)
    {
        $topik = ForumTopik::where('slug', $slug)->firstOrFail();

        // Only the author or admin can update
        if ($topik->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit topik ini.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string|min:10',
        ]);

        $topik->update($validated);

        return redirect()->route('forum.show', $topik->slug)
            ->with('success', 'Topik forum berhasil diperbarui!');
    }

    /**
     * Remove the specified topic
     */
    public function destroy($slug)
    {
        $topik = ForumTopik::where('slug', $slug)->firstOrFail();

        // Only the author or admin can delete
        if ($topik->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus topik ini.');
        }

        $topik->delete();

        return redirect()->route('forum.index')
            ->with('success', 'Topik forum berhasil dihapus!');
    }

    /**
     * Store a reply to a topic
     */
    public function storeBalasan(Request $request, $slug)
    {
        $topik = ForumTopik::where('slug', $slug)->firstOrFail();

        // Check if topic is locked
        if ($topik->is_locked) {
            return back()->with('error', 'Topik ini telah dikunci dan tidak dapat dibalas.');
        }

        $validated = $request->validate([
            'konten' => 'required|string|min:5',
        ]);

        ForumBalasan::create([
            'forum_topik_id' => $topik->id,
            'user_id' => Auth::id(),
            'konten' => $validated['konten'],
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }

    /**
     * Delete a reply
     */
    public function destroyBalasan($id)
    {
        $balasan = ForumBalasan::findOrFail($id);

        // Only the author or admin can delete
        if ($balasan->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus balasan ini.');
        }

        $balasan->delete();

        return back()->with('success', 'Balasan berhasil dihapus!');
    }
}
