<x-public-layout>
    <x-slot name="title">Struktur Organisasi</x-slot>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Struktur Organisasi</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    HIMPAUDI Kecamatan Bekasi Timur
                </p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="font-semibold text-blue-600">Struktur Organisasi</span>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Introduction Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mb-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-3">Tentang Struktur Organisasi</h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Struktur organisasi HIMPAUDI Kecamatan Bekasi Timur dirancang untuk memastikan pengelolaan yang efektif 
                            dan profesional dalam mendukung pengembangan pendidikan anak usia dini di wilayah Bekasi Timur.
                        </p>
                        <p class="text-gray-600 leading-relaxed">
                            Setiap bidang memiliki peran dan tanggung jawab yang spesifik untuk mencapai visi dan misi organisasi 
                            dalam meningkatkan kualitas PAUD di Indonesia.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Struktur Organisasi Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Bagan Struktur Organisasi
                    </h3>
                    <p class="text-gray-600">Periode Kepengurusan 2023-2028</p>
                </div>

                <!-- Organization Chart Image -->
                <div class="relative bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-300 overflow-hidden">
                    <div class="flex justify-center items-center">
                        @if(file_exists(public_path('images/struktur-organisasi.png')))
                            <img src="{{ asset('images/struktur-organisasi.png') }}" 
                                 alt="Struktur Organisasi HIMPAUDI Bekasi Timur" 
                                 class="max-w-full h-auto rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        @else
                            <div class="text-center py-16">
                                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-500 text-lg font-medium mb-2">Gambar Struktur Organisasi</p>
                                <p class="text-gray-400 text-sm">Simpan gambar struktur organisasi sebagai:</p>
                                <code class="text-xs bg-gray-200 px-3 py-1 rounded mt-2 inline-block">public/images/struktur-organisasi.png</code>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Download Button -->
                @if(file_exists(public_path('images/struktur-organisasi.png')))
                <div class="mt-6 text-center">
                    <a href="{{ asset('images/struktur-organisasi.png') }}" 
                       download="struktur-organisasi-himpaudi-bektim.png"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download Struktur Organisasi
                    </a>
                </div>
                @endif
            </div>

            <!-- Bidang-Bidang Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bidang Organisasi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900">Bidang Organisasi</h4>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Mengelola administrasi dan kelembagaan organisasi, termasuk database keanggotaan dan dokumentasi kegiatan.
                    </p>
                </div>

                <!-- Bidang Diklat & Litbang -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900">Bidang Diklat & Litbang</h4>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Menyelenggarakan pendidikan dan pelatihan serta penelitian untuk peningkatan kompetensi pendidik PAUD.
                    </p>
                </div>

                <!-- Bidang Humas & Kerjasama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900">Bidang Humas & Kerjasama</h4>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Membangun hubungan dan kemitraan dengan stakeholder serta mempromosikan program organisasi.
                    </p>
                </div>

                <!-- Bidang Sosial & Ekonomi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900">Bidang Sosial & Ekonomi</h4>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Mengembangkan program kesejahteraan anggota dan pemberdayaan ekonomi lembaga PAUD.
                    </p>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-blue-900 mb-2">Informasi Lebih Lanjut</h4>
                        <p class="text-blue-800 text-sm">
                            Untuk informasi lebih detail mengenai program kerja dan kegiatan masing-masing bidang, 
                            silakan hubungi sekretariat HIMPAUDI Kecamatan Bekasi Timur atau kunjungi halaman kontak kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
