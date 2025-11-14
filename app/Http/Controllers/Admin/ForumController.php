<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumTopik;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of forum topics for admin
     */
    public function index()
    {
        $topiks = ForumTopik::with(['user', 'balasan'])
            ->withCount('balasan')
            ->latest()
            ->paginate(20);

        return view('admin.forum.index', compact('topiks'));
    }

    /**
     * Toggle pin status
     */
    public function togglePin($id)
    {
        $topik = ForumTopik::findOrFail($id);
        $topik->update(['is_pinned' => !$topik->is_pinned]);

        $status = $topik->is_pinned ? 'dipasang' : 'dilepas';
        return back()->with('success', "Topik berhasil {$status}!");
    }

    /**
     * Toggle lock status
     */
    public function toggleLock($id)
    {
        $topik = ForumTopik::findOrFail($id);
        $topik->update(['is_locked' => !$topik->is_locked]);

        $status = $topik->is_locked ? 'dikunci' : 'dibuka';
        return back()->with('success', "Topik berhasil {$status}!");
    }

    /**
     * Remove the specified topic
     */
    public function destroy($id)
    {
        $topik = ForumTopik::findOrFail($id);
        $topik->delete();

        return back()->with('success', 'Topik berhasil dihapus!');
    }
}
