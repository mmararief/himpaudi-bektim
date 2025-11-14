<x-public-layout>
    <x-slot name="title">
        {{ $galeri->judul_kegiatan }} - Galeri HIMPAUDI Bekasi Timur
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Image -->
                <div class="relative">
                    <img src="{{ asset('storage/'.$galeri->file_gambar) }}" 
                         alt="{{ $galeri->judul_kegiatan }}"
                         class="w-full h-auto max-h-[600px] object-contain bg-gray-100">
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $galeri->judul_kegiatan }}</h1>
                        
                        <div class="flex items-center text-gray-600 mb-4">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium">{{ $galeri->tanggal_kegiatan->format('d F Y') }}</span>
                        </div>
                    </div>

                    @if($galeri->deskripsi)
                        <div class="prose max-w-none">
                            <div class="p-6 rounded-xl" style="background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);">
                                <h3 class="text-lg font-bold text-indigo-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                    </svg>
                                    Deskripsi Kegiatan
                                </h3>
                                <p class="text-gray-800 leading-relaxed">{{ $galeri->deskripsi }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Navigation -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                        @php
                            $previous = \App\Models\Galeri::where('id', '<', $galeri->id)->orderBy('id', 'desc')->first();
                            $next = \App\Models\Galeri::where('id', '>', $galeri->id)->orderBy('id', 'asc')->first();
                        @endphp

                        <div>
                            @if($previous)
                                <a href="{{ route('galeri.show', $previous) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Sebelumnya
                                </a>
                            @endif
                        </div>

                        <div>
                            @if($next)
                                <a href="{{ route('galeri.show', $next) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                                    Selanjutnya
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Galeri
                </a>
            </div>
        </div>
    </div>
</x-public-layout>
