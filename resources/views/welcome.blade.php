<x-public-layout>
    <x-slot name="title">{{ config('app.name', 'HIMPAUDI Bekasi Timur') }} - Bersama Membangun PAUD Berkualitas</x-slot>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-800">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg text-sm font-semibold mb-6 border border-white/30">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                        Platform Resmi HIMPAUDI Bekasi Timur
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Bersama Membangun<br />
                        PAUD Berkualitas<br />
                        di Bekasi Timur
                    </h1>
                    <p class="text-lg text-blue-50 mb-8 leading-relaxed">
                        Platform digital terpadu untuk pendaftaran anggota, informasi kegiatan, berita, galeri dokumentasi, dan kolaborasi pendidik PAUD.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 font-semibold bg-white text-blue-700 rounded-lg hover:bg-blue-50 shadow-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Daftar Anggota
                        </a>
                        <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-6 py-3 font-semibold border-2 border-white text-white rounded-lg hover:bg-white/10 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Lihat Galeri
                        </a>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo-himpaudi.png') }}" alt="Logo HIMPAUDI" class="w-64 md:w-80 lg:w-96 h-auto drop-shadow-2xl animate-float">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ \App\Models\User::member()->count() }}+</div>
                    <div class="text-gray-600 font-medium">Anggota Terdaftar</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-700 mb-2">{{ \App\Models\User::active()->member()->count() }}+</div>
                    <div class="text-gray-600 font-medium">Anggota Aktif</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-500 mb-2">{{ \App\Models\Galeri::count() }}+</div>
                    <div class="text-gray-600 font-medium">Galeri Foto</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-800 mb-2">{{ \App\Models\Berita::count() }}+</div>
                    <div class="text-gray-600 font-medium">Kegiatan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Kegiatan -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Galeri Kegiatan</h2>
                <p class="text-gray-600">Dokumentasi kegiatan dan acara HIMPAUDI Bekasi Timur</p>
            </div>

            @php
            $recentGaleri = \App\Models\Galeri::latest('tanggal_kegiatan')->take(6)->get();
            @endphp

            @if($recentGaleri->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                @foreach($recentGaleri as $galeri)
                <a href="{{ route('galeri.show', $galeri) }}" class="group relative aspect-square overflow-hidden rounded-lg shadow-sm hover:shadow-lg transition-all duration-300">
                    <img src="{{ asset('storage/'.$galeri->file_gambar) }}"
                        alt="{{ $galeri->judul_kegiatan }}"
                        class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="font-semibold line-clamp-2">{{ $galeri->judul_kegiatan }}</h3>
                            <p class="text-sm text-gray-200">{{ $galeri->tanggal_kegiatan->format('d M Y') }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition-colors">
                    Lihat Semua Galeri
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
            @else
            <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-gray-500">Galeri akan segera hadir</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Visi & Misi</h2>
                <p class="text-gray-600">Komitmen kami untuk pendidikan anak usia dini</p>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="p-8 rounded-xl border border-gray-200 bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-blue-600 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Visi</h3>
                    </div>
                    @if(!empty($visiMisi?->visi))
                    <p class="text-gray-700 leading-relaxed">{{ $visiMisi->visi }}</p>
                    @else
                    <p class="text-gray-600">Terwujudnya pendidikan anak usia dini yang berkualitas dan merata di Bekasi Timur.</p>
                    @endif
                </div>
                <div class="p-8 rounded-xl border border-gray-200 bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-blue-600 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Misi</h3>
                    </div>
                    @if(!empty($misiList))
                    <ul class="space-y-3">
                        @foreach($misiList as $m)
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700 leading-relaxed">{{ $m }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @elseif(!empty($visiMisi?->misi))
                    <p class="text-gray-700 leading-relaxed">{{ $visiMisi->misi }}</p>
                    @else
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Meningkatkan kualitas pendidik PAUD</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Memfasilitasi kolaborasi antar lembaga PAUD</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Mengembangkan sistem administrasi yang efektif</span>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-blue-700 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Bergabunglah Bersama Kami!</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Daftar sekarang dan menjadi bagian dari komunitas pendidik PAUD Bekasi Timur
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-700 font-bold rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-blue-800 text-white font-bold rounded-lg shadow-sm hover:bg-blue-900 border border-white/30 transition-colors">
                    Sudah Punya Akun? Login
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">FAQ</h2>
                <p class="text-gray-600">Temukan jawaban atas pertanyaan umum seputar HIMPAUDI Bekasi Timur</p>
            </div>
            <div class="space-y-4">
                @if(($faqs ?? collect())->count())
                @foreach($faqs as $f)
                <details class="group bg-white border border-gray-200 rounded-lg p-6 hover:border-blue-300 transition-colors shadow-sm">
                    <summary class="cursor-pointer font-semibold text-gray-900 flex items-center justify-between">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $f->pertanyaan }}
                        </span>
                        <span class="ml-4 h-8 w-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center flex-shrink-0 group-open:rotate-45 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </span>
                    </summary>
                    <div class="mt-4 pl-8 text-gray-700 leading-relaxed">{!! nl2br(e($f->jawaban)) !!}</div>
                </details>
                @endforeach
                @else
                <!-- Default FAQ -->
                <details class="group bg-white border border-gray-200 rounded-lg p-6 hover:border-blue-300 transition-colors shadow-sm">
                    <summary class="cursor-pointer font-semibold text-gray-900 flex items-center justify-between">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Siapa yang bisa mendaftar sebagai anggota?
                        </span>
                        <span class="ml-4 h-8 w-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center flex-shrink-0 group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <div class="mt-4 pl-8 text-gray-700 leading-relaxed">
                        Pendidik dan tenaga kependidikan yang bekerja di lembaga PAUD (Pendidikan Anak Usia Dini) di wilayah Kecamatan Bekasi Timur dapat mendaftar sebagai anggota HIMPAUDI.
                    </div>
                </details>

                <details class="group bg-white border border-gray-200 rounded-lg p-6 hover:border-blue-300 transition-colors shadow-sm">
                    <summary class="cursor-pointer font-semibold text-gray-900 flex items-center justify-between">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Bagaimana cara mendaftar?
                        </span>
                        <span class="ml-4 h-8 w-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center flex-shrink-0 group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <div class="mt-4 pl-8 text-gray-700 leading-relaxed">
                        Klik tombol "Daftar Sekarang", isi formulir pendaftaran dengan lengkap (data pribadi dan data lembaga), tunggu verifikasi dari admin. Anda akan menerima notifikasi email setelah akun disetujui.
                    </div>
                </details>

                <details class="group bg-white border border-gray-200 rounded-lg p-6 hover:border-blue-300 transition-colors shadow-sm">
                    <summary class="cursor-pointer font-semibold text-gray-900 flex items-center justify-between">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Berapa lama proses verifikasi?
                        </span>
                        <span class="ml-4 h-8 w-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center flex-shrink-0 group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <div class="mt-4 pl-8 text-gray-700 leading-relaxed">
                        Proses verifikasi biasanya memakan waktu 1-3 hari kerja. Admin akan memeriksa kelengkapan dan kebenaran data yang Anda berikan.
                    </div>
                </details>
                @endif
            </div>
        </div>
    </section>

</x-public-layout>