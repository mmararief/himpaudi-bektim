<x-public-layout :title="$berita->judul">
    <section class="bg-white py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('berita.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali ke Berita</a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $berita->judul }}</h1>
            <div class="text-sm text-gray-500 mb-6 flex items-center gap-4">
                <span>{{ optional($berita->published_at)->format('d M Y, H:i') }}</span>
                @if($berita->user)
                    · <span>Oleh {{ $berita->user->name ?? $berita->user->username ?? 'Admin' }}</span>
                @endif
                · <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    {{ number_format($berita->views) }} views
                </span>
                · <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    {{ $berita->comments->count() }} komentar
                </span>
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

            <!-- Comments Section -->
            <div class="mt-12 border-t pt-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Komentar ({{ $berita->comments->count() }})</h2>

                @auth
                    <!-- Comment Form -->
                    <div class="mb-8">
                        <form action="{{ route('berita.comment.store', $berita->slug) }}" method="POST" class="bg-gray-50 rounded-lg p-4">
                            @csrf
                            <div class="mb-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Tulis Komentar</label>
                                <textarea name="comment" id="comment" rows="4" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Tulis komentar Anda...">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="mb-8 bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-gray-600">
                            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> untuk berkomentar
                        </p>
                    </div>
                @endauth

                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse($berita->comments as $comment)
                        <div class="bg-white rounded-lg border border-gray-200 p-4">
                            <div class="flex items-start gap-3">
                                @if($comment->user->dataPribadi?->foto_profil)
                                    <img src="{{ asset('storage/'.$comment->user->dataPribadi->foto_profil) }}" 
                                        class="w-10 h-10 rounded-full object-cover" 
                                        alt="{{ $comment->user->dataPribadi->nama_lengkap ?? $comment->user->username }}">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($comment->user->dataPribadi?->nama_lengkap ?? $comment->user->username, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <a href="{{ route('public.profile.show', $comment->user) }}" class="font-semibold text-gray-900 hover:text-blue-600 transition">
                                            {{ $comment->user->dataPribadi?->nama_lengkap ?? $comment->user->username }}
                                        </a>
                                        <span class="text-sm text-gray-500">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 whitespace-pre-line">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            Belum ada komentar. Jadilah yang pertama berkomentar!
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
