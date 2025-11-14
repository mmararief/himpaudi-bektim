<x-admin-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('admin.faq.index') }}" 
                       class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-800">Edit FAQ</h2>
                </div>
                <p class="text-gray-600 ml-9">Perbarui pertanyaan yang sering ditanyakan</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow">
                <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Pertanyaan -->
                    <div>
                        <label for="pertanyaan" class="block text-sm font-medium text-gray-700 mb-2">
                            Pertanyaan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="pertanyaan" 
                               name="pertanyaan" 
                               maxlength="500"
                               value="{{ old('pertanyaan', $faq->pertanyaan) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pertanyaan') border-red-500 @enderror"
                               placeholder="Contoh: Bagaimana cara mendaftar menjadi anggota?"
                               required>
                        @error('pertanyaan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Maksimal 500 karakter</p>
                    </div>

                    <!-- Jawaban -->
                    <div>
                        <label for="jawaban" class="block text-sm font-medium text-gray-700 mb-2">
                            Jawaban <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban" 
                                  name="jawaban" 
                                  rows="6"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jawaban') border-red-500 @enderror"
                                  placeholder="Masukkan jawaban lengkap untuk pertanyaan ini..."
                                  required>{{ old('jawaban', $faq->jawaban) }}</textarea>
                        @error('jawaban')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Berikan jawaban yang jelas dan informatif</p>
                    </div>

                    <!-- Urutan -->
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                            Urutan Tampilan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="urutan" 
                               name="urutan" 
                               min="1"
                               value="{{ old('urutan', $faq->urutan) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('urutan') border-red-500 @enderror"
                               required>
                        @error('urutan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">FAQ akan ditampilkan berdasarkan urutan dari yang terkecil</p>
                    </div>

                    <!-- Is Active -->
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', $faq->is_active) ? 'checked' : '' }}
                                   class="w-5 h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                            <div>
                                <span class="text-sm font-medium text-gray-700">Aktifkan Sekarang</span>
                                <p class="text-xs text-gray-500">FAQ ini akan ditampilkan di halaman landing page</p>
                            </div>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('admin.faq.index') }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
