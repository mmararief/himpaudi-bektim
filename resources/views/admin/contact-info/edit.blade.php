<x-admin-layout>
    <x-slot name="title">Edit Kontak</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Edit Kontak</h2>
                <p class="text-gray-600 mt-1">Perbarui informasi kontak organisasi</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.contact-info.update', $contactInfo) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea name="alamat" rows="3" required
                                      class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('alamat') border-red-500 @enderror">{{ old('alamat', $contactInfo->alamat) }}</textarea>
                            @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $contactInfo->email) }}" required
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                            <input type="text" name="telepon" value="{{ old('telepon', $contactInfo->telepon) }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('telepon') border-red-500 @enderror">
                            @error('telepon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- WhatsApp -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $contactInfo->whatsapp) }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('whatsapp') border-red-500 @enderror">
                            @error('whatsapp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Maps Embed -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Google Maps Embed URL</label>
                            <textarea name="maps_embed" rows="3"
                                      class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('maps_embed') border-red-500 @enderror">{{ old('maps_embed', $contactInfo->maps_embed) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Salin URL embed dari Google Maps</p>
                            @error('maps_embed')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.contact-info.index') }}" 
                           class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition-colors">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
