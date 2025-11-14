<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest('created_at')->paginate(12);
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'file_gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'deskripsi' => 'nullable|string',
            'tanggal_kegiatan' => 'required|date',
        ]);

        if ($request->hasFile('file_gambar')) {
            $validated['file_gambar'] = $request->file('file_gambar')->store('galeri', 'public');
        }

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'deskripsi' => 'nullable|string',
            'tanggal_kegiatan' => 'required|date',
        ]);

        if ($request->hasFile('file_gambar')) {
            // Delete old image
            if ($galeri->file_gambar) {
                Storage::disk('public')->delete($galeri->file_gambar);
            }
            $validated['file_gambar'] = $request->file('file_gambar')->store('galeri', 'public');
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy(Galeri $galeri)
    {
        // Delete image file
        if ($galeri->file_gambar) {
            Storage::disk('public')->delete($galeri->file_gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus!');
    }
}
