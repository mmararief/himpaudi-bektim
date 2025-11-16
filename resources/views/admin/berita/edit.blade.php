<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Berita</h1>
    </div>

    <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" class="w-full px-3 py-2 border rounded-lg" required>
            @error('judul')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
            <textarea name="konten" rows="8" class="w-full px-3 py-2 border rounded-lg" required>{{ old('konten', $berita->konten) }}</textarea>
            @error('konten')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail (opsional)</label>
            <input type="file" name="thumbnail" accept="image/*" class="w-full">
            @if($berita->thumbnail)
                <img src="{{ asset('storage/'.$berita->thumbnail) }}" class="w-32 h-24 object-cover rounded mt-2" />
            @endif
            <p class="text-xs text-gray-500 mt-1">Upload baru untuk mengganti. Maks 2MB.</p>
            @error('thumbnail')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Berita Saat Ini</label>
            @if($berita->photos->count() > 0)
                <div class="grid grid-cols-4 gap-3 mb-3">
                    @foreach($berita->photos as $photo)
                        <div class="relative group">
                            <img src="{{ asset('storage/'.$photo->photo_path) }}" class="w-full h-24 object-cover rounded border">
                            <label class="absolute top-1 right-1 bg-red-600 text-white rounded p-1 cursor-pointer hover:bg-red-700 transition">
                                <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" class="sr-only">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </label>
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-500">Centang foto untuk menghapus</p>
            @else
                <p class="text-sm text-gray-500 mb-3">Belum ada foto</p>
            @endif

            <label class="block text-sm font-medium text-gray-700 mb-1 mt-4">Tambah Foto Baru</label>
            <input type="file" name="photos[]" accept="image/*" multiple class="w-full" id="photos-input">
            <p class="text-xs text-gray-500 mt-1">Pilih beberapa foto sekaligus (Ctrl/Cmd + Klik). Format: JPG/PNG/WEBP. Maks 2MB per foto.</p>
            @error('photos.*')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            
            <div id="preview-container" class="mt-3 grid grid-cols-3 gap-2"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_published" value="1" class="rounded" {{ old('is_published', $berita->is_published) ? 'checked' : '' }}>
                <span class="text-sm text-gray-700">Published</span>
            </label>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publish</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($berita->published_at)->format('Y-m-d\TH:i')) }}" class="w-full px-3 py-2 border rounded-lg">
                @error('published_at')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 rounded-lg border">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white">Perbarui</button>
        </div>
    </form>

    @push('scripts')
    <script>
        document.getElementById('photos-input').addEventListener('change', function(e) {
            const preview = document.getElementById('preview-container');
            preview.innerHTML = '';
            
            if (this.files) {
                Array.from(this.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-24 object-cover rounded border">
                            <span class="absolute top-1 left-1 bg-blue-600 text-white text-xs px-2 py-0.5 rounded">${index + 1}</span>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });

        // Handle delete checkbox visual feedback
        document.querySelectorAll('input[name="delete_photos[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const container = this.closest('.relative');
                if (this.checked) {
                    container.classList.add('opacity-50', 'ring-2', 'ring-red-500');
                } else {
                    container.classList.remove('opacity-50', 'ring-2', 'ring-red-500');
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>
