@if(auth()->user()->isAdmin())
    <x-admin-layout>
        <x-slot name="header">
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
            <p class="text-gray-500 text-sm mt-1">Selamat datang di panel administrasi HIMPAUDI Bekasi Timur.</p>
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

        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm">
                <li class="flex items-center">
                    <span class="font-semibold text-blue-600">Dashboard</span>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Dashboard Anggota</h2>
                    <p class="text-gray-600 mt-1">Selamat datang, <span class="font-semibold">{{ $dataPribadi->nama_lengkap ?? $user->username }}</span></p>
                </div>
                <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm flex items-center gap-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak KTA
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content (left 2/3) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Digital KTA Card -->
                <div class="rounded-2xl p-6 shadow-lg relative overflow-hidden kta-pattern" style="background: linear-gradient(to bottom right, #1e40af, #2563eb); color: #ffffff;">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                    
                    <div class="flex justify-between items-start mb-6 relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center font-bold text-xl shadow-md" style="color: #1e3a8a;">H</div>
                            <div>
                                <h3 class="font-bold text-lg tracking-wide" style="color: #ffffff;">HIMPAUDI</h3>
                                <p class="text-xs uppercase tracking-wider font-medium" style="color: rgba(255, 255, 255, 0.9);">Kartu Tanda Anggota Digital</p>
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
                                    <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">NIPTK / NUPTK</p>
                                    <p class="font-medium font-mono" style="color: #ffffff;">{{ $dataPribadi->niptk_nuptk ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">Wilayah</p>
                                    <p class="font-medium" style="color: #ffffff;">Bekasi Timur</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs uppercase font-medium" style="color: rgba(255, 255, 255, 0.8);">Unit Kerja</p>
                                <p class="font-medium" style="color: #ffffff;">{{ $dataLembaga->nama_lembaga ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 flex justify-between items-center relative z-10" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                        <p class="text-xs italic" style="color: rgba(255, 255, 255, 0.85);">Berlaku selama menjadi anggota aktif Himpaudi.</p>
                        <p class="text-xs font-mono" style="color: #ffffff;">ID: HMP-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                <!-- Status Card (conditional) -->
                @if($user->status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-5">
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
                    <div class="bg-red-50 border border-red-200 rounded-lg p-5">
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

                <!-- Info Terbaru Section -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            Informasi Terbaru
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <a href="#" class="block group">
                                <div class="flex gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition line-clamp-2">Undangan Workshop Kurikulum Merdeka PAUD</h4>
                                        <p class="text-xs text-gray-500 mt-1">12 Januari 2024 • Administrator</p>
                                    </div>
                                </div>
                            </a>
                            <hr class="border-gray-200">
                            <a href="#" class="block group">
                                <div class="flex gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                        <div class="w-full h-full bg-gradient-to-br from-green-400 to-green-600"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition line-clamp-2">Jadwal Pertemuan Rutin Bulan Februari</h4>
                                        <p class="text-xs text-gray-500 mt-1">08 Januari 2024 • Administrator</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="#" class="block text-center text-sm text-blue-600 font-medium hover:text-blue-700 transition-colors">Lihat Semua Informasi →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar (right 1/3) -->
            <div class="space-y-6">
                <!-- Profile Completion Widget -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
                        <h4 class="text-sm font-bold text-gray-900">Kelengkapan Data Profil</h4>
                    </div>
                    <div class="p-5">
                        @php
                            $completeness = 0;
                            if($dataPribadi) {
                                $fields = ['nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'no_hp', 'pendidikan_terakhir', 'alamat_domisili'];
                                $filled = collect($fields)->filter(fn($f) => !empty($dataPribadi->$f))->count();
                                $completeness = round(($filled / count($fields)) * 100);
                            }
                        @endphp
                        <div class="flex mb-3 items-center justify-between">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-lg text-blue-700 bg-blue-100 border border-blue-200">{{ $completeness }}%</span>
                            <span class="text-xs font-semibold text-gray-600">{{ $completeness >= 80 ? 'Hampir Lengkap' : 'Perlu Dilengkapi' }}</span>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-100">
                            <div style="width:{{ $completeness }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600"></div>
                        </div>
                        @if($completeness < 100)
                            <p class="text-xs text-gray-500">Data Anda belum lengkap. <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Update Sekarang</a></p>
                        @endif
                    </div>
                </div>

                <!-- Hot Discussions Widget -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h4 class="text-sm font-bold text-gray-900">Diskusi Terhangat</h4>
                        <a href="{{ route('forum.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium transition-colors">Lihat Forum →</a>
                    </div>
                    <div class="p-5">
                        <ul class="space-y-3">
                            @forelse(\App\Models\ForumTopik::withCount('balasan')->orderBy('balasan_count', 'desc')->take(2)->get() as $topik)
                                <li class="pb-3 border-b border-gray-200 last:border-0 last:pb-0">
                                    <a href="{{ route('forum.show', $topik->slug) }}" class="block hover:bg-gray-50 -mx-2 p-2 rounded-lg transition-colors">
                                        <span class="inline-block px-2 py-0.5 rounded text-xs font-medium text-blue-700 bg-blue-100 border border-blue-200 mb-2">{{ $topik->kategori }}</span>
                                        <p class="text-sm font-medium text-gray-900 line-clamp-2 mb-2">{{ $topik->judul }}</p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            <span>{{ $topik->balasan_count }} Tanggapan</span>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="text-sm text-gray-500 text-center py-6">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p>Belum ada diskusi tersedia</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-member-layout>
@endif
