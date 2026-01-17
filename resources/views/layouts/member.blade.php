<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }} - Member Area</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .kta-pattern {
            background-image: radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 20%);
            background-size: 20px 20px;
        }

        /* Force white text on KTA card */
        .kta-pattern * {
            color: inherit;
        }
        .kta-pattern p,
        .kta-pattern h3,
        .kta-pattern span {
            color: inherit !important;
        }

        /* Print Styles */
        @media print {
            /* Hide navigation and sidebar */
            nav.bg-blue-900,
            aside {
                display: none !important;
            }

            /* Reset main content positioning */
            main {
                margin-left: 0 !important;
                padding: 0 !important;
            }

            /* Hide elements with print:hidden class */
            .print\\:hidden {
                display: none !important;
            }

            /* Remove background color from body */
            body {
                background: white !important;
            }

            /* Ensure colors print correctly */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Top Navigation Bar -->
    <nav class="bg-blue-900 border-b border-blue-800 fixed w-full z-30 top-0">
        <div class="px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                       <img src="{{ asset('images/logo-himpaudi.png') }}" alt="Logo HIMPAUDI" class="h-10 w-auto">
                    <div>
                        <h1 class="text-white font-semibold text-lg leading-tight">HIMPAUDI</h1>
                        <p class="text-blue-200 text-xs">Anggota - Bekasi Timur</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                @php
                    $user = Auth::user();
                    $dataPribadi = $user->dataPribadi ?? null;
                @endphp
                <div class="hidden md:flex text-right flex-col">
                    <span class="text-white text-sm font-medium">{{ $dataPribadi->nama_lengkap ?? $user->username }}</span>
                    <span class="text-blue-200 text-xs">
                        @if($user->status === 'active')
                            Anggota Aktif
                        @elseif($user->status === 'pending')
                            Menunggu Verifikasi
                        @else
                            Anggota
                        @endif
                    </span>
                </div>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-8 h-8 rounded-full bg-white border-2 border-blue-300 overflow-hidden focus:outline-none focus:ring-2 focus:ring-white">
                        @if($dataPribadi && $dataPribadi->foto_profil)
                            <img src="{{ asset('storage/'.$dataPribadi->foto_profil) }}" alt="Profil" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($user->username, 0, 1)) }}
                            </div>
                        @endif
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50" style="display: none;">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-900">{{ $user->username }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                        </div>
                        <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Lihat Profil
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Profil
                        </a>
                        <div class="border-t border-gray-100 my-2"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-16 h-screen overflow-hidden">
        <!-- Left Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block overflow-y-auto fixed h-full left-0 top-16 z-20">
            <div class="p-4">
                <div class="mb-6 px-4">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium {{ request()->routeIs('profile.show') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Profil Saya
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.lembaga') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium {{ request()->routeIs('profile.lembaga') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                Data Lembaga
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Profil
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mb-6 px-4">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Komunitas</p>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('forum.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium {{ request()->routeIs('forum.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                                Forum Diskusi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('galeri.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium {{ request()->routeIs('galeri.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Galeri Kegiatan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 md:ml-64 h-full overflow-y-auto p-8">
            <div class="max-w-5xl mx-auto">
                <!-- Page Header (Optional) -->
                @if(isset($header))
                    <div class="mb-8">
                        {{ $header }}
                    </div>
                @endif

                <!-- Main Content -->
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
