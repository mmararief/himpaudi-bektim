<x-public-layout :title="'Berita'">
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Berita</h1>
                <form method="GET" class="hidden md:block">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Cari berita..." class="px-3 py-2 border rounded-lg w-64">
                </form>
            </div>

            @if($items->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $b)
                        <a href="{{ route('berita.show', $b->slug) }}" class="group bg-white rounded-lg border hover:shadow transition overflow-hidden">
                            @if($b->thumbnail)
                                <img src="{{ asset('storage/'.$b->thumbnail) }}" class="w-full h-44 object-cover group-hover:opacity-95 transition" alt="{{ $b->judul }}">
                            @else
                                <div class="w-full h-44 bg-gray-100 flex items-center justify-center text-gray-400">Tidak ada gambar</div>
                            @endif
                            <div class="p-4">
                                <div class="text-xs text-gray-500 mb-1">{{ optional($b->published_at)->format('d M Y') }}</div>
                                <h2 class="font-semibold text-gray-900 line-clamp-2 mb-2">{{ $b->judul }}</h2>
                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ number_format($b->views ?? 0) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                        {{ $b->comments_count ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8">{{ $items->links() }}</div>
            @else
                <div class="text-center py-16 bg-gray-50 rounded-lg border">Belum ada berita</div>
            @endif
        </div>
    </section>
</x-public-layout>
