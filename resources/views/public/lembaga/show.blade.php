<x-public-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav class="flex items-center gap-2 text-sm text-blue-100 mb-4">
                <a href="{{ route('public.search', ['q' => request('q')]) }}" class="hover:text-white">← Kembali ke Pencarian</a>
            </nav>
            <h1 class="text-3xl font-bold">Detail Lembaga</h1>
            <p class="text-blue-100 mt-1">Informasi lengkap dan daftar anggota terdaftar</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Lembaga Info Card -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div class="flex items-start gap-6">
                @if($lembaga->foto_sekolah)
                    <img src="{{ asset('storage/'.$lembaga->foto_sekolah) }}" alt="Foto {{ $lembaga->nama_sekolah }}" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
                @else
                    <div class="w-32 h-32 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-4xl font-bold">
                        {{ strtoupper(substr($lembaga->nama_sekolah, 0, 1)) }}
                    </div>
                @endif
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $lembaga->nama_sekolah }}</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">NPSN</div>
                                <div class="font-semibold text-gray-900">{{ $lembaga->npsn ?: '-' }}</div>
                            </div>
                        </div>

                        @if($lembaga->akreditasi)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Akreditasi</div>
                                    <div class="font-semibold text-gray-900">{{ $lembaga->akreditasi }} @if($lembaga->tahun_akreditasi)<span class="text-gray-500">({{ $lembaga->tahun_akreditasi }})</span>@endif</div>
                                </div>
                            </div>
                        @endif

                        @if($lembaga->nama_kepala_sekolah)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Kepala Sekolah</div>
                                    <div class="font-semibold text-gray-900">{{ $lembaga->nama_kepala_sekolah }}</div>
                                </div>
                            </div>
                        @endif

                        @if($lembaga->jumlah_guru || $lembaga->jumlah_siswa)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Guru & Siswa</div>
                                    <div class="font-semibold text-gray-900">{{ $lembaga->jumlah_guru ?: 0 }} Guru • {{ $lembaga->jumlah_siswa ?: 0 }} Siswa</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($lembaga->alamat)
                        <div class="mt-4 flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Alamat Lengkap</div>
                                <div class="text-sm text-gray-700">{{ $lembaga->alamat }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Anggota Terdaftar -->
        <div>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Anggota Terdaftar ({{ $anggota->total() }})
                </h3>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($anggota as $u)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow border border-gray-200 p-6">
                        <div class="flex flex-col items-center text-center">
                            @if(optional($u->dataPribadi)->foto_profil)
                                <img src="{{ asset('storage/' . $u->dataPribadi->foto_profil) }}" alt="{{ optional($u->dataPribadi)->nama_lengkap }}" class="w-24 h-24 rounded-full object-cover mb-4">
                            @else
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold mb-4">
                                    {{ strtoupper(substr(optional($u->dataPribadi)->nama_lengkap ?: $u->username, 0, 1)) }}
                                </div>
                            @endif
                            <h4 class="text-lg font-semibold text-gray-900 mb-1">
                                {{ optional($u->dataPribadi)->nama_lengkap ?: $u->username }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-3">{{ $u->email }}</p>
                            @if(optional($u->dataPribadi)->pendidikan_terakhir)
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full mb-4">
                                    {{ $u->dataPribadi->pendidikan_terakhir }}
                                </span>
                            @endif
                            <a href="{{ route('public.profile.show', $u) }}" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors inline-flex items-center justify-center gap-2">
                                Lihat Profil
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <p class="text-gray-500 text-lg">Belum ada akun yang terdaftar dengan NPSN ini</p>
                    </div>
                @endforelse
            </div>

            @if($anggota->hasPages())
                <div class="mt-8">{{ $anggota->onEachSide(1)->links() }}</div>
            @endif
        </div>
    </div>
</x-public-layout>
