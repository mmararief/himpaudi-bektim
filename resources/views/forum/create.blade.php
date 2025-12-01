<x-member-layout>
    <x-slot name="title">Buat Topik Baru</x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('forum.index') }}" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Buat Topik Diskusi Baru</h1>
                    <p class="text-gray-600 mt-1">Mulai diskusi baru dengan anggota lainnya</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
                <form action="{{ route('forum.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Judul -->
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Topik <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('judul') @enderror"
                               placeholder="Masukkan judul topik yang jelas dan deskriptif"
                               required>
                        @error('judul')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Buat judul yang menarik dan menjelaskan isi diskusi</p>
                    </div>

                    <!-- Konten -->
                    <div>
                        <label for="konten" class="block text-sm font-semibold text-gray-700 mb-2">
                            Isi Diskusi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="konten" 
                                  name="konten" 
                                  rows="12"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('konten') @enderror"
                                  placeholder="Jelaskan topik diskusi Anda secara detail..."
                                  required>{{ old('konten') }}</textarea>
                        @error('konten')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Minimal 10 karakter. Jelaskan dengan detail agar mendapat respon yang baik</p>
                    </div>

                    <!-- Guidelines -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-2">Panduan Membuat Topik:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Gunakan bahasa yang sopan dan profesional</li>
                                    <li>• Hindari konten yang menyinggung SARA</li>
                                    <li>• Pastikan topik relevan dengan PAUD dan pendidikan</li>
                                    <li>• Gunakan judul yang jelas dan mudah dipahami</li>
                                    <li>• Berikan konteks yang cukup dalam isi diskusi</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4 border-t">
                        <a href="{{ route('forum.index') }}" 
                           class="flex-1 py-3 px-6 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Publikasikan Topik
                        </button>
                    </div>
                </form>
        </div>
    </div>
</x-member-layout>
