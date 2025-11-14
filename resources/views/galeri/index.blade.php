<x-public-layout>
    <x-slot name="title">
        Galeri Kegiatan - HIMPAUDI Bekasi Timur
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="mb-8 rounded-2xl shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 50%, #1E40AF 100%);">
                <div class="p-8 text-white text-center">
                    <h1 class="text-4xl font-bold mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Galeri Kegiatan</h1>
                    <p class="text-lg" style="color: rgba(255,255,255,0.95);">Dokumentasi Kegiatan HIMPAUDI Bekasi Timur</p>
                </div>
            </div>

            @if($galeris->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($galeris as $galeri)
                        <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <a href="{{ route('galeri.show', $galeri) }}" class="block">
                                <div class="aspect-square overflow-hidden bg-gray-200">
                                    <img src="{{ asset('storage/'.$galeri->file_gambar) }}" 
                                         alt="{{ $galeri->judul_kegiatan }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                         loading="lazy">
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition">
                                        {{ $galeri->judul_kegiatan }}
                                    </h3>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $galeri->tanggal_kegiatan->format('d F Y') }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $galeris->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                    <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Foto</h3>
                    <p class="text-gray-600">Galeri kegiatan masih kosong. Nantikan dokumentasi kegiatan selanjutnya!</p>
                </div>
            @endif
        </div>
    </div>
</x-public-layout>
