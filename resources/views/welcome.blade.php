<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'HIMPAUDI Bekasi Timur') }} - Bersama Membangun PAUD Berkualitas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="flex items-center gap-3">
                            <img src="{{ asset('images/logo-himpaudi.png') }}" alt="Logo HIMPAUDI" class="h-12 w-auto">
                            <div class="hidden sm:block">
                                <div class="text-sm font-bold text-gray-800">HIMPAUDI</div>
                                <div class="text-xs text-gray-500">Bekasi Timur</div>
                            </div>
                        </a>

                        <!-- Navigation Links -->
                        <div class="hidden md:flex md:ml-10 space-x-8">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-blue-600 border-b-2 border-blue-600 transition">
                                Beranda
                            </a>
                            <a href="{{ route('berita.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                Berita
                            </a>
                            <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                Galeri
                            </a>
                            <a href="{{ route('forum.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                Forum
                            </a>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                Daftar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>

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
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                        Platform Resmi HIMPAUDI Bekasi Timur
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Bersama Membangun<br/>
                        PAUD Berkualitas<br/>
                        di Bekasi Timur
                    </h1>
                    <p class="text-lg text-blue-50 mb-8 leading-relaxed">
                        Platform digital terpadu untuk pendaftaran anggota, informasi kegiatan, berita, galeri dokumentasi, dan kolaborasi pendidik PAUD.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 font-semibold bg-white text-blue-700 rounded-lg hover:bg-blue-50 shadow-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Daftar Anggota
                        </a>
                        <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-6 py-3 font-semibold border-2 border-white text-white rounded-lg hover:bg-white/10 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
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
                    <div class="text-4xl font-bold text-blue-800 mb-2">15+</div>
                    <div class="text-gray-600 font-medium">Kelurahan</div>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
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
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
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
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Misi</h3>
                    </div>
                    @if(!empty($misiList))
                        <ul class="space-y-3">
                            @foreach($misiList as $m)
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
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
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">Meningkatkan kualitas pendidik PAUD</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">Memfasilitasi kolaborasi antar lembaga PAUD</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
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
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-gray-600">Temukan jawaban atas pertanyaan umum seputar HIMPAUDI Bekasi Timur</p>
            </div>
            <div class="space-y-4">
                @if(($faqs ?? collect())->count())
                    @foreach($faqs as $f)
                        <details class="group bg-white border border-gray-200 rounded-lg p-6 hover:border-blue-300 transition-colors shadow-sm">
                            <summary class="cursor-pointer font-semibold text-gray-900 flex items-center justify-between">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $f->pertanyaan }}
                                </span>
                                <span class="ml-4 h-8 w-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center flex-shrink-0 group-open:rotate-45 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
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

    <!-- Footer -->
    @php
        $activeContact = \App\Models\ContactInfo::where('is_active', true)->first();
    @endphp
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo-himpaudi.png') }}" alt="Logo HIMPAUDI" class="h-12 w-auto">
                        <div class="text-white font-bold">HIMPAUDI<br/>Bekasi Timur</div>
                    </div>
                    <p class="text-sm leading-relaxed">
                        Himpunan Pendidik dan Tenaga Kependidikan Anak Usia Dini Kecamatan Bekasi Timur
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">Menu Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('register') }}" class="hover:text-blue-400 transition">Daftar Anggota</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-blue-400 transition">Login</a></li>
                        <li><a href="{{ route('galeri.index') }}" class="hover:text-blue-400 transition">Galeri</a></li>
                        <li><a href="#faq" class="hover:text-blue-400 transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $activeContact?->alamat ?? 'Kecamatan Bekasi Timur, Kota Bekasi, Jawa Barat' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $activeContact?->email ?? 'info@himpaudibekasitimur.id' }}</span>
                        </li>
                        @if($activeContact?->telepon)
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>{{ $activeContact->telepon }}</span>
                        </li>
                        @endif
                        @if($activeContact?->whatsapp)
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $activeContact->whatsapp) }}" target="_blank" class="hover:text-blue-400 transition">{{ $activeContact->whatsapp }}</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row items-center justify-between text-sm">
                <div>© {{ date('Y') }} HIMPAUDI Bekasi Timur. All rights reserved.</div>
                <div class="text-gray-500 mt-2 md:mt-0">Dibangun dengan ❤️ menggunakan Laravel & Tailwind CSS</div>
            </div>
        </div>
    </footer>
</body>
</html>
