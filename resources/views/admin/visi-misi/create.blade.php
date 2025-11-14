<x-admin-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('admin.visi-misi.index') }}" 
                       class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Visi & Misi</h2>
                </div>
                <p class="text-gray-600 ml-9">Tambahkan konten visi dan misi organisasi</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow">
                <form action="{{ route('admin.visi-misi.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Visi -->
                    <div>
                        <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">
                            Visi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="visi" 
                                  name="visi" 
                                  rows="5"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('visi') border-red-500 @enderror"
                                  placeholder="Masukkan visi organisasi..."
                                  required>{{ old('visi') }}</textarea>
                        @error('visi')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Jelaskan visi jangka panjang organisasi</p>
                    </div>

                    <!-- Misi -->
                    <div>
                        <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">
                            Misi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="misi" 
                                  name="misi" 
                                  rows="8"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('misi') border-red-500 @enderror"
                                  placeholder="Masukkan misi organisasi..."
                                  required>{{ old('misi') }}</textarea>
                        @error('misi')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Jelaskan langkah-langkah untuk mencapai visi</p>
                    </div>

                    <!-- Is Active -->
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active') ? 'checked' : '' }}
                                   class="w-5 h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                            <div>
                                <span class="text-sm font-medium text-gray-700">Aktifkan Sekarang</span>
                                <p class="text-xs text-gray-500">Visi & misi ini akan ditampilkan di halaman landing page</p>
                            </div>
                        </label>
                    </div>

                    <!-- Info Alert -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-sm text-yellow-800">
                                <p class="font-medium mb-1">Perhatian:</p>
                                <p>Jika Anda mengaktifkan visi & misi ini, semua visi & misi lain akan otomatis dinonaktifkan karena hanya satu yang dapat aktif pada satu waktu.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('admin.visi-misi.index') }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
