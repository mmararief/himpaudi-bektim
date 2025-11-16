<x-member-layout>
    <x-slot name="title">Data Sekolah</x-slot>

    <div class="max-w-7xl mx-auto">
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a></li>
                    <li class="text-gray-400">/</li>
                    <li class="text-gray-600 font-medium">Data Sekolah</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-8 text-white shadow-lg">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">Data Sekolah/Lembaga PAUD</h2>
                        <p class="text-blue-100">Informasi lengkap sekolah/lembaga Anda</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors shadow-md flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Data
                    </a>
                </div>
            </div>

            @if($dataLembaga && $dataLembaga->id)
            <!-- Data Lembaga Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <div class="flex items-start gap-6">
                    <div class="p-4 bg-blue-100 rounded-xl">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $dataLembaga->nama_lembaga }}</h3>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @if($dataLembaga->npsn)
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                NPSN: {{ $dataLembaga->npsn }}
                            </span>
                            @endif
                            @if(isset($lembagaMaster) && $lembagaMaster)
                                @if($lembagaMaster->akreditasi)
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Akreditasi: {{ $lembagaMaster->akreditasi }}@if($lembagaMaster->tahun_akreditasi) ({{ $lembagaMaster->tahun_akreditasi }}) @endif
                                </span>
                                @endif
                            @endif
                        </div>
                        
                        <!-- Detail Information -->
                        <div class="space-y-4 border-t pt-6">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-40">
                                    <span class="text-sm font-medium text-gray-500">Nama Lembaga</span>
                                </div>
                                <div class="flex-1">
                                    <span class="text-sm text-gray-900 font-medium">{{ $dataLembaga->nama_lembaga }}</span>
                                </div>
                            </div>
                            @if($dataLembaga->npsn)
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-40">
                                    <span class="text-sm font-medium text-gray-500">NPSN</span>
                                </div>
                                <div class="flex-1">
                                    <span class="text-sm text-gray-900 font-mono font-medium">{{ $dataLembaga->npsn }}</span>
                                </div>
                            </div>
                            @endif

                            @if(isset($lembagaMaster) && $lembagaMaster)
                                @if($lembagaMaster->nama_kepala_sekolah)
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-40">
                                        <span class="text-sm font-medium text-gray-500">Kepala Sekolah</span>
                                    </div>
                                    <div class="flex-1"><span class="text-sm text-gray-900 font-medium">{{ $lembagaMaster->nama_kepala_sekolah }}</span></div>
                                </div>
                                @endif

                                @if($lembagaMaster->alamat)
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-40">
                                        <span class="text-sm font-medium text-gray-500">Alamat</span>
                                    </div>
                                    <div class="flex-1"><span class="text-sm text-gray-900">{{ $lembagaMaster->alamat }}</span></div>
                                </div>
                                @endif

                                @if($lembagaMaster->jumlah_guru || $lembagaMaster->jumlah_siswa)
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-40">
                                        <span class="text-sm font-medium text-gray-500">Jumlah Guru & Siswa</span>
                                    </div>
                                    <div class="flex-1">
                                        <span class="text-sm text-gray-900">{{ $lembagaMaster->jumlah_guru ?: 0 }} Guru • {{ $lembagaMaster->jumlah_siswa ?: 0 }} Siswa</span>
                                    </div>
                                </div>
                                @endif

                                @if($lembagaMaster->foto_sekolah)
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-40">
                                        <span class="text-sm font-medium text-gray-500">Foto Sekolah</span>
                                    </div>
                                    <div class="flex-1">
                                        <img src="{{ asset('storage/'.$lembagaMaster->foto_sekolah) }}" alt="Foto Sekolah" class="w-48 h-32 object-cover rounded-lg border">
                                    </div>
                                </div>
                                @endif

                                <div class="pt-4 mt-4 border-t">
                                    <a href="{{ route('public.lembaga.show', $lembagaMaster) }}" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        Lihat Halaman Publik Lembaga
                                    </a>
                                </div>
                            @else
                                <div class="pt-6">
                                    <p class="text-sm text-gray-500">Data master lembaga belum terhubung. Pastikan NPSN sesuai agar otomatis terhubung.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
                <svg class="w-16 h-16 text-yellow-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-yellow-800 mb-2">Data Sekolah Belum Tersedia</h3>
                <p class="text-yellow-700 mb-4">Silakan lengkapi data sekolah Anda terlebih dahulu.</p>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Lengkapi Data Sekolah
                </a>
            </div>
            @endif

            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ route('profile.show') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Profil Anggota
                </a>
            </div>

        </div>
    </div>

    @push('scripts')
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
    @endpush
</x-member-layout>
