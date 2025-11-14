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
            <article class="prose max-w-none">
                {!! nl2br(e($berita->konten)) !!}
            </article>
        </div>
    </section>
</x-public-layout>
