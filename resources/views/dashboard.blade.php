@if(auth()->user()->isAdmin())
    <x-admin-layout>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
                    <p class="text-gray-500 text-sm mt-1">Selamat datang di panel administrasi HIMPAUDI Bekasi Timur.</p>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Ke Beranda
                </a>
            </div>
        </x-slot>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Pending Members Card -->
            <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Menunggu Verifikasi</p>
                    <p class="text-2xl font-bold text-orange-600">{{ \App\Models\User::pending()->member()->count() }} Orang</p>
                </div>
                <div class="p-3 bg-orange-50 rounded-full text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Active Members Card -->
            <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Anggota Aktif</p>
                    <p class="text-2xl font-bold text-green-600">{{ \App\Models\User::active()->member()->count() }} Orang</p>
                </div>
                <div class="p-3 bg-green-50 rounded-full text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Rejected Members Card -->
            <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Anggota Ditolak</p>
                    <p class="text-2xl font-bold text-red-600">{{ \App\Models\User::rejected()->member()->count() }} Orang</p>
                </div>
                <div class="p-3 bg-red-50 rounded-full text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Menu Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.members.pending') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                        <div class="bg-blue-100 rounded-lg p-2 mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Verifikasi Anggota</p>
                            <p class="text-xs text-gray-500">Review pendaftaran baru</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.members.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                        <div class="bg-green-100 rounded-lg p-2 mr-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Data Anggota</p>
                            <p class="text-xs text-gray-500">Kelola anggota aktif</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.galeri.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                        <div class="bg-purple-100 rounded-lg p-2 mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Kelola Galeri</p>
                            <p class="text-xs text-gray-500">Upload & kelola foto</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </x-admin-layout>
@else
    <x-member-layout>
        <x-slot name="title">Dashboard Member</x-slot>
        
        @php
            $user = auth()->user();
            $user->loadMissing(['dataPribadi', 'dataLembaga']);
            $dataPribadi = $user->dataPribadi;
            $dataLembaga = $user->dataLembaga;
        @endphp

        <!-- Print Styles -->
        <style>
            @media print {
                /* Hide everything by default */
                body * {
                    visibility: hidden;
                }
                
                /* Show only KTA card */
                #kta-card, #kta-card * {
                    visibility: visible;
                }
                
                #kta-card {
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                    width: 400px !important;
                    max-width: 400px !important;
                    margin: 0 !important;
                    box-shadow: none !important;
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                    color-adjust: exact !important;
                }

                /* Hide navigation, sidebar, other sections */
                nav, aside, .no-print, .print\\:hidden {
                    display: none !important;
                }

                @page {
                    size: A4 landscape;
                    margin: 0;
                }
            }
        </style>

        <!-- Breadcrumb -->
        <nav class="mb-6 print:hidden">
            <ol class="flex items-center space-x-2 text-sm">
                <li class="flex items-center">
                    <span class="font-semibold text-blue-600">Dashboard</span>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="mb-8 print:hidden">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Dashboard Akun Situs</h2>
                    <p class="text-gray-600 mt-1">Selamat datang, <span class="font-semibold">{{ $dataPribadi->nama_lengkap ?? $user->username }}</span></p>
                </div>
                <div class="flex gap-2">
                                        <a href="{{ route('home') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm flex items-center gap-2 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                            Ke Beranda
                                        </a>
                    <a href="{{ route('cetak-kta') }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm flex items-center gap-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Lihat KTA
                    </a>
                    <a href="{{ route('download-kta') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm flex items-center gap-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download PDF
                    </a>
                </div>
            </div>
        </div>

        <div class="space-y-6">
                <!-- Digital KTA Card -->
                <div id="kta-card" class="rounded-2xl p-6 shadow-lg relative overflow-hidden kta-pattern" style="background: linear-gradient(to bottom right, #1e40af, #2563eb); color: #ffffff;">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                    
                    <div class="flex justify-between items-start mb-6 relative z-10">
                        <div class="flex items-center gap-3">
                            <img  src="{{ asset('images/logo-himpaudi.png') }}" alt="Logo HIMPAUDI" class="w-12 h-12">
                            
                            <div>
                                <h3 class="font-bold text-lg tracking-wide" style="color: #ffffff;">HIMPAUDI</h3>
                                <p class="text-xs uppercase tracking-wider font-medium" style="color: rgba(255, 255, 255, 0.9);">Kartu Akses Akun Lokal</p>
                            </div>
                        </div>
                        @if($user->status === 'active')
                            <div class="bg-green-400 text-green-900 text-xs font-bold px-2 py-1 rounded uppercase">Aktif</div>
                        @elseif($user->status === 'pending')
                            <div class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded uppercase">Pending</div>
                        @else
                            <div class="bg-red-400 text-red-900 text-xs font-bold px-2 py-1 rounded uppercase">Non-Aktif</div>
                        @endif
                    </div>

                    <div class="flex flex-col md:flex-row gap-6 relative z-10 items-center md:items-start">
                        <div class="w-24 h-32 bg-gray-200 rounded-lg border-2 border-white/30 shadow-inner overflow-hidden flex-shrink-0">
                            @if($dataPribadi && $dataPribadi->foto_profil)
                                <img src="{{ asset('storage/'.$dataPribadi->foto_profil) }}" class="w-full h-full object-cover" alt="Foto Member">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white font-bold text-3xl">
                                    {{ strtoupper(substr($user->username, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1 space-y-3 w-full text-center md:text-left">
                            <div>
                                <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">Nama Lengkap</p>
                                <p class="font-bold text-xl" style="color: #ffffff;">{{ $dataPribadi->nama_lengkap ?? $user->username }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">No Anggota</p>
                                    <p class="font-medium font-mono" style="color: #ffffff;">HMP-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">Wilayah</p>
                                    <p class="font-medium" style="color: #ffffff;">Bekasi Timur</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">Unit Kerja</p>
                                    <p class="font-medium" style="color: #ffffff;">{{ $dataLembaga->nama_lembaga ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">Jabatan</p>
                                    <p class="font-medium" style="color: #ffffff;">{{ $dataLembaga->jabatan ?? '-' }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">Kelurahan</p>
                                <p class="font-medium" style="color: #ffffff;">{{ $dataLembaga->kelurahan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 flex justify-between items-center relative z-10" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                        <p class="text-xs italic" style="color: rgba(255, 255, 255, 0.85);">Untuk keanggotaan resmi nasional silakan kunjungi himpaudi.org.</p>
                        <p class="text-xs font-mono" style="color: #ffffff;">ID: HMP-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                <!-- Status Card (conditional) -->
                @if($user->status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-5 print:hidden">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-yellow-900 mb-1">Status: Menunggu Verifikasi</h3>
                                <p class="text-sm text-yellow-800 leading-relaxed">Data pendaftaran Anda sedang ditinjau oleh administrator. Anda akan menerima notifikasi setelah proses verifikasi selesai.</p>
                            </div>
                        </div>
                    </div>
                @elseif($user->status === 'rejected')
                    <div class="bg-red-50 border border-red-200 rounded-lg p-5 print:hidden">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-red-900 mb-1">Status: Pendaftaran Tidak Disetujui</h3>
                                <p class="text-sm text-red-800 leading-relaxed">Mohon maaf, data pendaftaran Anda tidak dapat disetujui. Silakan hubungi administrator untuk informasi lebih lanjut.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Data Pribadi Section -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden print:hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Data Pribadi
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Lengkap</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataPribadi->nama_lengkap ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">No. KTP</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataPribadi->no_ktp ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tempat, Tanggal Lahir</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataPribadi->tempat_lahir ?? '-' }}, {{ $dataPribadi->tanggal_lahir ? $dataPribadi->tanggal_lahir->format('d M Y') : '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jenis Kelamin</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataPribadi->jenis_kelamin ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Pendidikan Terakhir</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataPribadi->pendidikan_terakhir ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">TMT Kerja</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataPribadi->tmt_kerja ? $dataPribadi->tmt_kerja->format('d M Y') : '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">No. HP</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataPribadi->no_hp ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email</p>
                                <p class="text-sm font-medium text-gray-900">{{ $user->email ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4 md:col-span-2">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Alamat Domisili</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataPribadi->alamat_domisili ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('profile.edit') }}" class="block text-center text-sm text-blue-600 font-medium hover:text-blue-700 transition-colors">Edit Data Pribadi →</a>
                        </div>
                    </div>
                </div>

                <!-- Data Lembaga Section -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden print:hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Data Lembaga
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Lembaga</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataLembaga->nama_lembaga ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">NPSN</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataLembaga->npsn ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jabatan</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataLembaga->jabatan ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Kelurahan</p>
                                <p class="text-sm font-medium text-gray-900">{{ $dataLembaga->kelurahan ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('profile.lembaga') }}" class="block text-center text-sm text-blue-600 font-medium hover:text-blue-700 transition-colors">Lihat Data Lembaga →</a>
                        </div>
                    </div>
                </div>
        </div>
    </x-member-layout>
@endif
