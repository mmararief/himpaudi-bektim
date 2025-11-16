<x-public-layout>
    <x-slot name="title">{{ $topik->judul }} - Forum Diskusi</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex items-center gap-2 text-sm text-gray-600">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <a href="{{ route('forum.index') }}" class="hover:text-blue-600">Forum Diskusi</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-gray-900 font-medium">{{ Str::limit($topik->judul, 40) }}</span>
                </nav>
            </div>

            <div class="max-w-5xl mx-auto">
            <!-- Success/Error Message -->
            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <!-- Topic Post -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
                <!-- Topic Header -->
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                @if($topik->is_pinned)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z"/>
                                    </svg>
                                    Topik Penting
                                </span>
                                @endif
                                
                                @if($topik->is_locked)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Diskusi Ditutup
                                </span>
                                @endif

                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    {{ $topik->kategori ?? 'Diskusi Umum' }}
                                </span>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900 leading-tight">{{ $topik->judul }}</h1>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-6 text-sm text-gray-600">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span class="font-medium">{{ $topik->views }}</span> dilihat
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                            <span class="font-medium">{{ $topik->balasan->count() }}</span> balasan
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Dibuat {{ $topik->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <!-- Topic Body -->
                <div class="p-6">
                    <div class="flex gap-6">
                        <!-- Author Info -->
                        <div class="flex-shrink-0">
                            <div class="text-center space-y-3">
                                @php
                                    $dataPribadi = $topik->user->dataPribadi ?? null;
                                @endphp
                                @if($dataPribadi && $dataPribadi->foto_profil)
                                    <img src="{{ asset('storage/'.$dataPribadi->foto_profil) }}" alt="{{ $topik->user->username }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200 mx-auto">
                                @else
                                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto border-2 border-gray-200">
                                        {{ strtoupper(substr($topik->user->username ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <a href="{{ route('public.profile.show', $topik->user) }}" class="text-sm font-bold text-gray-900 hover:text-blue-600 transition block">
                                        {{ $dataPribadi->nama_lengkap ?? $topik->user->username ?? 'Unknown' }}
                                    </a>
                                    @if($topik->user->role === 'admin')
                                        <span class="inline-block mt-1 px-2 py-0.5 bg-red-100 text-red-700 text-xs font-semibold rounded">Administrator</span>
                                    @else
                                        <span class="inline-block mt-1 px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-medium rounded">Anggota</span>
                                    @endif
                                    <p class="text-xs text-gray-500 mt-2">Bergabung {{ $topik->user->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="prose prose-sm max-w-none">
                                <p class="text-gray-800 text-base leading-relaxed whitespace-pre-line">{{ $topik->konten }}</p>
                            </div>

                            <!-- Actions -->
                            @auth
                            @if($topik->user_id === Auth::id() || Auth::user()->isAdmin())
                            <div class="mt-6 pt-5 border-t border-gray-200 flex items-center gap-4">
                                <a href="{{ route('forum.edit', $topik->slug) }}" 
                                   class="inline-flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 font-medium transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Topik
                                </a>
                                <form action="{{ route('forum.destroy', $topik->slug) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus topik diskusi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-2 text-sm text-gray-700 hover:text-red-600 font-medium transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus Topik
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Replies Section -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        Tanggapan Diskusi <span class="text-gray-500 font-normal">({{ $topik->balasan->count()}})</span>
                    </h2>
                </div>

                <!-- Reply List -->
                <div class="divide-y divide-gray-100">
                    @forelse($topik->balasan as $balasan)
                    <div class="p-6 hover:bg-gray-50/50 transition">
                        <div class="flex gap-5">
                            <!-- Author Avatar -->
                            <div class="flex-shrink-0">
                                @php
                                    $balasanPribadi = $balasan->user->dataPribadi ?? null;
                                @endphp
                                @if($balasanPribadi && $balasanPribadi->foto_profil)
                                    <img src="{{ asset('storage/'.$balasanPribadi->foto_profil) }}" alt="{{ $balasan->user->username }}" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                                @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold border-2 border-gray-200">
                                        {{ strtoupper(substr($balasan->user->username ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Reply Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4 mb-3">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('public.profile.show', $balasan->user) }}" class="font-bold text-gray-900 hover:text-blue-600 transition text-sm">
                                                {{ $balasanPribadi->nama_lengkap ?? $balasan->user->username ?? 'Unknown' }}
                                            </a>
                                            @if($balasan->user->role === 'admin')
                                                <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-semibold rounded">Admin</span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $balasan->created_at->format('d M Y, H:i') }} · {{ $balasan->created_at->diffForHumans() }}</p>
                                    </div>
                                    
                                    @auth
                                    @if($balasan->user_id === Auth::id() || Auth::user()->isAdmin())
                                    <form action="{{ route('forum.balasan.destroy', $balasan->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus tanggapan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                    @endauth
                                </div>
                                
                                <p class="text-gray-800 text-sm leading-relaxed whitespace-pre-line">{{ $balasan->konten }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-16 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p class="text-gray-500 font-medium">Belum ada tanggapan untuk diskusi ini</p>
                        <p class="text-gray-400 text-sm mt-1">Jadilah yang pertama memberikan tanggapan</p>
                    </div>
                    @endforelse
                </div>

                <!-- Reply Form -->
                @auth
                @if(!$topik->is_locked)
                <div class="bg-gray-50 p-6 border-t border-gray-200">
                    <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Tulis Tanggapan Anda
                    </h3>
                    <form action="{{ route('forum.balasan.store', $topik->slug) }}" method="POST">
                        @csrf
                        <div class="space-y-3">
                            <textarea name="konten" 
                                      rows="5"
                                      class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none @error('konten') border-red-500 @enderror"
                                      placeholder="Bagikan pemikiran, pendapat, atau pertanyaan Anda terkait diskusi ini..."
                                      required>{{ old('konten') }}</textarea>
                            @error('konten')
                            <p class="text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                            
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-gray-500">Sampaikan tanggapan dengan sopan dan konstruktif</p>
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg transition-colors inline-flex items-center gap-2 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Kirim Tanggapan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="bg-red-50 p-8 border-t border-red-200 text-center">
                    <svg class="w-14 h-14 mx-auto mb-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-red-700 font-semibold text-lg">Diskusi Telah Ditutup</p>
                    <p class="text-red-600 text-sm mt-1">Topik ini tidak menerima tanggapan baru.</p>
                </div>
                @endif
                @else
                <div class="bg-blue-50 p-8 border-t border-blue-200 text-center">
                    <svg class="w-14 h-14 mx-auto mb-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <p class="text-gray-700 font-medium mb-2">Silakan login terlebih dahulu</p>
                    <p class="text-gray-600 text-sm mb-4">Anda harus login sebagai anggota untuk berpartisipasi dalam diskusi</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login Sekarang
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</x-public-layout>
