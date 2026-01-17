<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'HIMPAUDI Bekasi Timur') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
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
                                <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                    Beranda
                                </a>
                                <a href="{{ route('struktur-organisasi') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('struktur-organisasi') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900' }} transition">
                                    Struktur Organisasi
                                </a>
                                <a href="{{ route('berita.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('berita.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900' }} transition">
                                    Berita
                                </a>
                                <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('galeri.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900' }} transition">
                                    Galeri
                                </a>
                                <a href="{{ route('forum.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('forum.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900' }} transition">
                                    Forum
                                </a>
                                
                            </div>
                        </div>



                        <!-- Right Side -->
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ route('public.search') }}" class="md:hidden inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 110-16 8 8 0 010 16z" />
                                    </svg>
                                    Cari
                                </a>
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('public.search') }}" class="md:hidden inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 110-16 8 8 0 010 16z" />
                                    </svg>
                                    Cari
                                </a>

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
                {{ $slot }}
            </main>

            <!-- Footer -->
            @php
                $activeContact = \App\Models\ContactInfo::where('is_active', true)->first();
            @endphp
            <footer class="bg-gray-900 text-gray-300 mt-16">
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
                                <li><a href="{{ route('register') }}" class="hover:text-blue-400 transition">Daftar Akun Situs</a></li>
                                <li><a href="{{ route('anggota.himpaudi') }}" target="_blank" rel="noopener" class="hover:text-blue-400 transition">Website Resmi Himpaudi</a></li>
                                <li><a href="{{ route('login') }}" class="hover:text-blue-400 transition">Login</a></li>
                                <li><a href="{{ route('berita.index') }}" class="hover:text-blue-400 transition">Berita</a></li>
                                <li><a href="{{ route('forum.index') }}" class="hover:text-blue-400 transition">Forum</a></li>
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
                    <div class="border-t border-gray-800 mt-8 pt-8 text-sm">
                        <div>© {{ date('Y') }} HIMPAUDI Bekasi Timur. All rights reserved.</div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
