<x-public-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold mb-2">Pencarian Lembaga & Anggota</h1>
            <p class="text-blue-100">Temukan informasi lembaga PAUD dan anggota komunitas</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search Form -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <form method="GET" action="{{ route('public.search') }}">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kata Kunci Pencarian</label>
                <div class="flex gap-3">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Masukkan nama lembaga, NPSN, nama anggota, atau email..." class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                    <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 110-16 8 8 0 010 16z" />
                        </svg>
                        Cari
                    </button>
                </div>
                @if($q)
                    <div class="mt-3 text-sm text-gray-600">
                        Menampilkan hasil pencarian untuk: <span class="font-semibold text-gray-900">"{{ $q }}"</span>
                    </div>
                @endif
            </form>
        </div>

        <!-- Results -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Lembaga Results -->
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Lembaga ({{ $lembaga->total() }})
                    </h2>
                </div>
                <div class="space-y-4">
                    @forelse ($lembaga as $l)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow border border-gray-200">
                            <div class="p-5">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <a href="{{ route('public.lembaga.show', $l) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition">
                                            {{ $l->nama_sekolah }}
                                        </a>
                                        <div class="mt-2 space-y-1">
                                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                                <span class="font-medium">NPSN:</span> {{ $l->npsn ?: '-' }}
                                            </div>
                                            @if($l->akreditasi)
                                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                                    </svg>
                                                    <span>Akreditasi <span class="font-bold">{{ $l->akreditasi }}</span></span>
                                                    @if($l->tahun_akreditasi)
                                                        <span class="text-gray-400">({{ $l->tahun_akreditasi }})</span>
                                                    @endif
                                                </div>
                                            @endif
                                            @if($l->alamat)
                                                <div class="flex items-start gap-2 text-sm text-gray-600">
                                                    <svg class="w-4 h-4 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <span class="line-clamp-2">{{ $l->alamat }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('public.lembaga.show', $l) }}" class="ml-4 px-4 py-2 bg-blue-50 text-blue-600 text-sm font-medium rounded-lg hover:bg-blue-100 transition-colors">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow p-8 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <p class="text-gray-500">Tidak ada lembaga ditemukan</p>
                        </div>
                    @endforelse
                </div>
                @if($lembaga->hasPages())
                    <div class="mt-6">{{ $lembaga->onEachSide(1)->links() }}</div>
                @endif
            </div>

            <!-- Anggota Results -->
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Anggota ({{ $anggota->total() }})
                    </h2>
                </div>
                <div class="space-y-4">
                    @forelse ($anggota as $u)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow border border-gray-200">
                            <div class="p-5">
                                <div class="flex items-start gap-4">
                                    @if(optional($u->dataPribadi)->foto_profil)
                                        <img src="{{ asset('storage/' . $u->dataPribadi->foto_profil) }}" alt="{{ optional($u->dataPribadi)->nama_lengkap }}" class="w-16 h-16 rounded-full object-cover">
                                    @else
                                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xl font-bold">
                                            {{ strtoupper(substr(optional($u->dataPribadi)->nama_lengkap ?: $u->username, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <a href="{{ route('public.profile.show', $u) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition">
                                            {{ optional($u->dataPribadi)->nama_lengkap ?: $u->username }}
                                        </a>
                                        <div class="mt-1 space-y-1">
                                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $u->email }}
                                            </div>
                                            @if($u->dataLembaga)
                                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                    {{ $u->dataLembaga->nama_lembaga }}
                                                    @if($u->dataLembaga->npsn)
                                                        <span class="text-gray-400">({{ $u->dataLembaga->npsn }})</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{ route('public.profile.show', $u) }}" class="mt-3 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                                            Lihat Profil
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow p-8 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <p class="text-gray-500">Tidak ada anggota ditemukan</p>
                        </div>
                    @endforelse
                </div>
                @if($anggota->hasPages())
                    <div class="mt-6">{{ $anggota->onEachSide(1)->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-public-layout>
