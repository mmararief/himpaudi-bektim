<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Tailwind CDN as Fallback -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-white to-indigo-50">
        <div class="min-h-screen flex">
            <!-- Left Side - Decorative Panel -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-12 flex-col justify-between relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
                </div>

                <!-- Content -->
                <div class="relative z-10">
                    <a href="/" class="inline-block">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="text-white">
                                <h1 class="text-2xl font-bold">HIMPAUDI</h1>
                                <p class="text-blue-200 text-sm">Bekasi Timur</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="relative z-10 text-white">
                    <h2 class="text-4xl font-bold mb-4 leading-tight">
                        Selamat Datang di<br/>
                        Sistem Informasi<br/>
                        HIMPAUDI Bekasi Timur
                    </h2>
                    <p class="text-blue-100 text-lg mb-8">
                        Platform digital komunitas lokal Bekasi Timur (forum & berita). Bukan portal pendaftaran resmi nasional.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Pendaftaran Online</h3>
                                <p class="text-blue-100 text-sm">Daftar akun lokal untuk ikut forum & komentar</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Verifikasi Otomatis</h3>
                                <p class="text-blue-100 text-sm">Akses akun diverifikasi oleh admin lokal</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Akses Dashboard</h3>
                                <p class="text-blue-100 text-sm">Kelola data dan informasi keanggotaan Anda</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 text-blue-200 text-sm">
                    <p>&copy; {{ date('Y') }} HIMPAUDI Bekasi Timur. All rights reserved.</p>
                </div>
            </div>

            <!-- Right Side - Form Panel -->
            <div class="flex-1 flex items-center justify-center p-6 sm:p-12">
                <div class="w-full max-w-2xl">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden mb-8 text-center">
                        <a href="/" class="inline-block">
                            <div class="flex items-center justify-center gap-3 mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-800">HIMPAUDI Bekasi Timur</h1>
                        </a>
                    </div>

                    <!-- Form Container -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10 border border-gray-100">
                        {{ $slot }}
                    </div>

                    <!-- Footer Links - Mobile -->
                    <div class="lg:hidden mt-6 text-center text-sm text-gray-600">
                        <a href="/" class="hover:text-blue-600 transition">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
