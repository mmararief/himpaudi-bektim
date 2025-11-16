<x-public-layout>
    <x-slot name="title">Forum Diskusi - HIMPAUDI Bekasi Timur</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl p-8 text-white text-center shadow-lg">
                    <h1 class="text-4xl font-bold mb-2">Forum Diskusi</h1>
                    <p class="text-lg text-blue-100">Berbagi dan berdiskusi dengan sesama anggota HIMPAUDI</p>
                    @auth
                    <div class="mt-6">
                        <a href="{{ route('forum.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-blue-700 font-semibold rounded-lg shadow-sm transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Topik Baru
                        </a>
                    </div>
                    @else
                    <div class="mt-6">
                        <p class="text-blue-100 mb-3">Ingin membuat topik diskusi?</p>
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-blue-700 font-semibold rounded-lg shadow-sm transition-colors">
                            Login untuk Memulai Diskusi
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <!-- Forum Topics List -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                @forelse($topiks as $topik)
                <div class="border-b border-gray-200 hover:bg-gray-50 transition">
                    <div class="p-6">
                        <div class="flex gap-4">
                            <!-- Author Avatar -->
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ strtoupper(substr($topik->user->username ?? 'U', 0, 1)) }}
                                </div>
                            </div>

                            <!-- Topic Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <!-- Topic Title with Badges -->
                                        <div class="flex items-center gap-2 mb-2">
                                            <a href="{{ route('forum.show', $topik->slug) }}" 
                                               class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition">
                                                {{ $topik->judul }}
                                            </a>
                                            
                                            @if($topik->is_pinned)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z"/>
                                                </svg>
                                                Pin
                                            </span>
                                            @endif
                                            
                                            @if($topik->is_locked)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Terkunci
                                            </span>
                                            @endif
                                        </div>

                                        <!-- Topic Meta -->
                                        <div class="flex items-center gap-4 text-sm text-gray-500">
                                            <a href="{{ route('public.profile.show', $topik->user) }}" class="flex items-center gap-1 hover:text-blue-600 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                {{ $topik->user->username ?? 'Unknown' }}
                                            </a>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                                </svg>
                                                {{ $topik->balasan_count }} Balasan
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                {{ $topik->views }} Views
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $topik->created_at->diffForHumans() }}
                                            </span>
                                        </div>

                                        <!-- Topic Preview -->
                                        <p class="mt-3 text-gray-600 line-clamp-2">
                                            {{ Str::limit(strip_tags($topik->konten), 150) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-gray-500 text-lg mb-4">Belum ada topik diskusi</p>
                    @auth
                    <a href="{{ route('forum.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Topik Pertama
                    </a>
                    @endauth
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($topiks->hasPages())
            <div class="mt-6">
                {{ $topiks->links() }}
            </div>
            @endif
        </div>
    </div>
</x-public-layout>
