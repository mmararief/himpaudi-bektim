<x-public-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav class="flex items-center gap-2 text-sm text-blue-100 mb-4">
                <a href="{{ route('public.search', ['q' => request('q')]) }}" class="hover:text-white">← Kembali ke Pencarian</a>
            </nav>
            <div class="flex items-center gap-6">
                @if(optional($user->dataPribadi)->foto_profil)
                    <img src="{{ asset('storage/' . $user->dataPribadi->foto_profil) }}" alt="{{ optional($user->dataPribadi)->nama_lengkap }}" class="w-24 h-24 rounded-full object-cover border-4 border-white/20">
                @else
                    <div class="w-24 h-24 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-white text-3xl font-bold border-4 border-white/20">
                        {{ strtoupper(substr(optional($user->dataPribadi)->nama_lengkap ?: $user->username, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold mb-1">{{ optional($user->dataPribadi)->nama_lengkap ?: $user->username }}</h1>
                    <p class="text-blue-100">{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Data Pribadi -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    Data Pribadi
                </h2>
                <div class="space-y-4">
                    @if(optional($user->dataPribadi)->niptk)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">NIPTK</div>
                                <div class="font-medium text-gray-900">{{ $user->dataPribadi->niptk }}</div>
                            </div>
                        </div>
                    @endif

                    @if(optional($user->dataPribadi)->tempat_lahir || optional($user->dataPribadi)->tanggal_lahir)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">Tempat, Tanggal Lahir</div>
                                <div class="font-medium text-gray-900">
                                    {{ $user->dataPribadi->tempat_lahir ?: '-' }}@if($user->dataPribadi->tanggal_lahir), {{ \Carbon\Carbon::parse($user->dataPribadi->tanggal_lahir)->isoFormat('D MMMM Y') }}@endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(optional($user->dataPribadi)->jenis_kelamin)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">Jenis Kelamin</div>
                                <div class="font-medium text-gray-900">{{ $user->dataPribadi->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                            </div>
                        </div>
                    @endif

                    @if(optional($user->dataPribadi)->pendidikan_terakhir)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">Pendidikan Terakhir</div>
                                <div class="font-medium text-gray-900">{{ $user->dataPribadi->pendidikan_terakhir }}</div>
                            </div>
                        </div>
                    @endif

                    @if(optional($user->dataPribadi)->tmt_kerja)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">TMT Kerja</div>
                                <div class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($user->dataPribadi->tmt_kerja)->isoFormat('D MMMM Y') }}</div>
                            </div>
                        </div>
                    @endif

                    @if(optional($user->dataPribadi)->riwayat_diklat)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">Riwayat Diklat</div>
                                <div class="text-sm text-gray-700 space-y-1">
                                    @foreach(is_array($user->dataPribadi->riwayat_diklat) ? $user->dataPribadi->riwayat_diklat : json_decode($user->dataPribadi->riwayat_diklat, true) as $diklat)
                                        <div class="flex items-start gap-2">
                                            <span class="text-blue-600">•</span>
                                            <span>{{ $diklat }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(optional($user->dataPribadi)->alamat)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">Alamat</div>
                                <div class="text-sm text-gray-700">{{ $user->dataPribadi->alamat }}</div>
                            </div>
                        </div>
                    @endif

                    @if(optional($user->dataPribadi)->no_hp)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">No. HP</div>
                                <div class="font-medium text-gray-900">{{ $user->dataPribadi->no_hp }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Data Lembaga -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    Data Lembaga
                </h2>
                <div class="space-y-4">
                    @if(optional($user->dataLembaga)->nama_lembaga)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">Nama Lembaga</div>
                                <div class="font-medium text-gray-900">{{ $user->dataLembaga->nama_lembaga }}</div>
                            </div>
                        </div>
                    @endif

                    @if(optional($user->dataLembaga)->npsn)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-1">NPSN</div>
                                <div class="font-medium text-gray-900">{{ $user->dataLembaga->npsn }}</div>
                            </div>
                        </div>
                    @endif

                    @if($user->lembagaMaster)
                        <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-semibold text-gray-900 mb-1">Lembaga Terdaftar</div>
                                    <div class="text-sm text-gray-700 mb-3">{{ $user->lembagaMaster->nama_sekolah }}</div>
                                    <a href="{{ route('public.lembaga.show', $user->lembagaMaster) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        Lihat Detail Lembaga
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!$user->dataPribadi && !$user->dataLembaga)
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-gray-500">Data profil belum lengkap</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
