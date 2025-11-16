<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Edit Lembaga</h2>
        <p class="text-gray-500 text-sm mt-1">Perbarui data lembaga.</p>
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

        <form action="{{ route('admin.lembaga-master.update', $item) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium">Nama Sekolah<span class="text-red-600">*</span></label>
                <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $item->nama_sekolah) }}" class="mt-1 w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">NPSN</label>
                    <input type="text" name="npsn" value="{{ old('npsn', $item->npsn) }}" class="mt-1 w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Nama Kepala Sekolah</label>
                    <input type="text" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $item->nama_kepala_sekolah) }}" class="mt-1 w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium">Alamat</label>
                <textarea name="alamat" rows="3" class="mt-1 w-full border rounded px-3 py-2">{{ old('alamat', $item->alamat) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium">Jumlah Guru</label>
                    <input type="number" name="jumlah_guru" value="{{ old('jumlah_guru', $item->jumlah_guru) }}" class="mt-1 w-full border rounded px-3 py-2" min="0">
                </div>
                <div>
                    <label class="block text-sm font-medium">Jumlah Siswa</label>
                    <input type="number" name="jumlah_siswa" value="{{ old('jumlah_siswa', $item->jumlah_siswa) }}" class="mt-1 w-full border rounded px-3 py-2" min="0">
                </div>
                <div>
                    <label class="block text-sm font-medium">Akreditasi</label>
                    <select name="akreditasi" class="mt-1 w-full border rounded px-3 py-2">
                        <option value="">-</option>
                        @foreach (['A','B','C','-'] as $opt)
                            <option value="{{ $opt }}" {{ old('akreditasi', $item->akreditasi) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Tahun Akreditasi</label>
                    <input type="number" name="tahun_akreditasi" value="{{ old('tahun_akreditasi', $item->tahun_akreditasi) }}" class="mt-1 w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Foto Sekolah</label>
                    <input type="file" name="foto_sekolah" accept="image/*" class="mt-1 w-full border rounded px-3 py-2">
                    @if ($item->foto_sekolah)
                        <img src="{{ asset('storage/'.$item->foto_sekolah) }}" alt="Foto Sekolah" class="mt-2 h-20 rounded">
                    @endif
                </div>
            </div>


            <div class="flex justify-end">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</x-admin-layout>
