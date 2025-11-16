<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->get('q');

        $berita = Berita::when($q, fn($query) => $query->where('judul', 'like', "%{$q}%"))
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.berita.index', compact('berita', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'photos.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_published' => ['sometimes', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['is_published'] = (bool)($data['is_published'] ?? false);
        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $berita = Berita::create($data);

        // Handle multiple photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('berita/photos', 'public');
                $berita->photos()->create([
                    'photo_path' => $path,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $beritum)
    {
        // Route-model binding uses singular parameter name; use $beritum to avoid clash
        $berita = $beritum;
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $beritum)
    {
        $berita = $beritum;

        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'photos.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'delete_photos' => ['nullable', 'array'],
            'delete_photos.*' => ['integer', 'exists:berita_photos,id'],
            'is_published' => ['sometimes', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        $data['is_published'] = (bool)($data['is_published'] ?? false);
        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $berita->update($data);

        // Delete selected photos
        if ($request->filled('delete_photos')) {
            $photosToDelete = BeritaPhoto::whereIn('id', $request->delete_photos)
                ->where('berita_id', $berita->id)
                ->get();

            foreach ($photosToDelete as $photo) {
                if (Storage::disk('public')->exists($photo->photo_path)) {
                    Storage::disk('public')->delete($photo->photo_path);
                }
                $photo->delete();
            }
        }

        // Add new photos
        if ($request->hasFile('photos')) {
            $currentMaxOrder = $berita->photos()->max('order') ?? -1;
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('berita/photos', 'public');
                $berita->photos()->create([
                    'photo_path' => $path,
                    'order' => $currentMaxOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $beritum)
    {
        $berita = $beritum;

        // Delete thumbnail
        if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
            Storage::disk('public')->delete($berita->thumbnail);
        }

        // Delete all photos
        foreach ($berita->photos as $photo) {
            if (Storage::disk('public')->exists($photo->photo_path)) {
                Storage::disk('public')->delete($photo->photo_path);
            }
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
