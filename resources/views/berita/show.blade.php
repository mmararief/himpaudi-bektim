<x-public-layout :title="$berita->judul">
    <section class="bg-white py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('berita.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali ke Berita</a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $berita->judul }}</h1>
            <div class="text-sm text-gray-500 mb-6">
                <span>{{ optional($berita->published_at)->format('d M Y, H:i') }}</span>
                @if($berita->user)
                    · <span>Oleh {{ $berita->user->name ?? $berita->user->username ?? 'Admin' }}</span>
                @endif
            </div>
            @if($berita->thumbnail)
                <img src="{{ asset('storage/'.$berita->thumbnail) }}" class="w-full h-72 object-cover rounded mb-6" alt="{{ $berita->judul }}">
            @endif
            <article class="prose max-w-none mb-8">
                {!! nl2br(e($berita->konten)) !!}
            </article>

            @if($berita->photos->count() > 0)
                <div class="mt-8 border-t pt-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Foto Berita</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($berita->photos as $photo)
                            <div class="group relative overflow-hidden rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer" onclick="openLightbox('{{ asset('storage/'.$photo->photo_path) }}')">
                                <img src="{{ asset('storage/'.$photo->photo_path) }}" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105" alt="Foto berita {{ $loop->iteration }}">
                                @if($photo->caption)
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                                        <p class="text-white text-sm">{{ $photo->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Lightbox Modal -->
                <div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4" onclick="closeLightbox()">
                    <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain" onclick="event.stopPropagation()">
                </div>

                <script>
                    function openLightbox(src) {
                        document.getElementById('lightbox').classList.remove('hidden');
                        document.getElementById('lightbox').classList.add('flex');
                        document.getElementById('lightbox-img').src = src;
                        document.body.style.overflow = 'hidden';
                    }
                    
                    function closeLightbox() {
                        document.getElementById('lightbox').classList.add('hidden');
                        document.getElementById('lightbox').classList.remove('flex');
                        document.body.style.overflow = 'auto';
                    }
                    
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') closeLightbox();
                    });
                </script>
            @endif
        </div>
    </section>
</x-public-layout>
