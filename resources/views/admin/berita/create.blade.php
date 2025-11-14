<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Berita</h1>
    </div>

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full px-3 py-2 border rounded-lg" required>
            @error('judul')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
            <textarea name="konten" rows="8" class="w-full px-3 py-2 border rounded-lg" required>{{ old('konten') }}</textarea>
            @error('konten')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail (opsional)</label>
            <input type="file" name="thumbnail" accept="image/*" class="w-full">
            <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG/WEBP. Maks 2MB.</p>
            @error('thumbnail')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_published" value="1" class="rounded" {{ old('is_published') ? 'checked' : '' }}>
                <span class="text-sm text-gray-700">Publish sekarang</span>
            </label>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publish (opsional)</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full px-3 py-2 border rounded-lg">
                @error('published_at')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 rounded-lg border">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white">Simpan</button>
        </div>
    </form>
</x-admin-layout>
