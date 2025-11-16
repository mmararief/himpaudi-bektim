<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Lembaga</h2>
        <p class="text-gray-500 text-sm mt-1">Masukkan data lembaga baru.</p>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('admin.lembaga-master.index') }}" class="text-blue-600 hover:underline">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.lembaga-master.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Nama Sekolah<span class="text-red-600">*</span></label>
                <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah') }}" class="mt-1 w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">NPSN</label>
                    <input type="text" name="npsn" value="{{ old('npsn') }}" class="mt-1 w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Nama Kepala Sekolah</label>
                    <input type="text" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah') }}" class="mt-1 w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium">Alamat</label>
                <textarea name="alamat" rows="3" class="mt-1 w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium">Jumlah Guru</label>
                    <input type="number" name="jumlah_guru" value="{{ old('jumlah_guru') }}" class="mt-1 w-full border rounded px-3 py-2" min="0">
                </div>
                <div>
                    <label class="block text-sm font-medium">Jumlah Siswa</label>
                    <input type="number" name="jumlah_siswa" value="{{ old('jumlah_siswa') }}" class="mt-1 w-full border rounded px-3 py-2" min="0">
                </div>
                <div>
                    <label class="block text-sm font-medium">Akreditasi</label>
                    <select name="akreditasi" class="mt-1 w-full border rounded px-3 py-2">
                        <option value="">-</option>
                        @foreach (['A','B','C','-'] as $opt)
                            <option value="{{ $opt }}" {{ old('akreditasi') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Tahun Akreditasi</label>
                    <input type="number" name="tahun_akreditasi" value="{{ old('tahun_akreditasi') }}" class="mt-1 w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Foto Sekolah</label>
                    <input type="file" name="foto_sekolah" accept="image/*" class="mt-1 w-full border rounded px-3 py-2">
                </div>
            </div>


            <div class="flex justify-end">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
