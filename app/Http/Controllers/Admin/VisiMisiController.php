<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisis = VisiMisi::latest()->paginate(10);
        return view('admin.visi-misi.index', compact('visiMisis'));
    }

    public function create()
    {
        return view('admin.visi-misi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'is_active' => 'boolean',
        ]);

        // Jika diset aktif, nonaktifkan yang lain
        if ($request->has('is_active') && $request->is_active) {
            VisiMisi::where('is_active', true)->update(['is_active' => false]);
        }

        VisiMisi::create($validated);

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil ditambahkan.');
    }

    public function edit(VisiMisi $visiMisi)
    {
        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    public function update(Request $request, VisiMisi $visiMisi)
    {
        $validated = $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'is_active' => 'boolean',
        ]);

        // Jika diset aktif, nonaktifkan yang lain
        if ($request->has('is_active') && $request->is_active) {
            VisiMisi::where('id', '!=', $visiMisi->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $visiMisi->update($validated);

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil diperbarui.');
    }

    public function destroy(VisiMisi $visiMisi)
    {
        $visiMisi->delete();

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil dihapus.');
    }

    public function toggleActive(VisiMisi $visiMisi)
    {
        // Nonaktifkan semua
        VisiMisi::where('is_active', true)->update(['is_active' => false]);

        // Aktifkan yang dipilih
        $visiMisi->update(['is_active' => true]);

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil diaktifkan.');
    }
}
