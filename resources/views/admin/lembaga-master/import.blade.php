<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Import Data Lembaga</h2>
        <p class="text-gray-500 text-sm mt-1">Upload file Excel untuk mengimpor data lembaga master.</p>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('admin.lembaga-master.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif

        @if (session('warning'))
            <div class="mb-4 p-3 rounded bg-yellow-100 text-yellow-800">
                {{ session('warning') }}
                @if (session('errors'))
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach (session('errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow space-y-6">
            <div class="bg-blue-50 border border-blue-200 rounded p-4">
                <h3 class="font-semibold text-blue-900 mb-2">📋 Format File CSV</h3>
                <p class="text-sm text-blue-800 mb-3">File CSV harus memiliki kolom header dengan urutan seperti ini:</p>
                <div class="bg-white rounded p-3 mb-3">
                    <code class="text-xs text-gray-700">
                        Nama Sekolah | NPSN | Alamat | Nama Kepala Sekolah | Jumlah Guru | Jumlah Siswa | Akreditasi ( Diisi A / B / C) | Tahun Akreditasi | Foto Tampak Depan Sekolah
                    </code>
                </div>
                <p class="text-xs text-blue-800 mb-2"><strong>Kolom yang wajib diisi:</strong></p>
                <ul class="list-disc list-inside text-xs text-blue-800 space-y-1 ml-3">
                    <li><strong>Nama Sekolah</strong> (wajib, tidak boleh kosong atau "Contoh")</li>
                    <li><strong>NPSN</strong> (opsional, tapi sangat disarankan untuk deteksi duplikat)</li>
                    <li><strong>Alamat</strong>, <strong>Nama Kepala Sekolah</strong> (opsional)</li>
                    <li><strong>Jumlah Guru</strong>, <strong>Jumlah Siswa</strong> (angka)</li>
                    <li><strong>Akreditasi</strong> (isi: A, B, C, atau -)</li>
                    <li><strong>Tahun Akreditasi</strong> (angka tahun, misal: 2024)</li>
                </ul>
                <p class="text-xs text-blue-700 mt-3">💡 <strong>Tips:</strong> Baris "Contoh" akan otomatis dilewati. Jika NPSN atau Nama Sekolah sudah ada, data akan diperbarui.</p>
            </div>

            <form action="{{ route('admin.lembaga-master.import.process') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-2">Pilih File CSV</label>
                    <input 
                        type="file" 
                        name="file" 
                        accept=".csv" 
                        class="w-full border rounded px-3 py-2"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Format yang didukung: .csv (max 10MB)</p>
                    <p class="text-xs text-yellow-600 mt-1">💡 Tip: Simpan file Excel Anda sebagai CSV (Comma delimited) terlebih dahulu</p>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.lembaga-master.index') }}" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Upload & Import
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 bg-gray-50 border border-gray-200 rounded p-4">
            <h3 class="font-semibold text-gray-800 mb-2">📝 Cara Konversi Excel ke CSV</h3>
            <ol class="list-decimal list-inside text-sm text-gray-600 space-y-1">
                <li>Buka file Excel Anda</li>
                <li>Klik <strong>File</strong> → <strong>Save As</strong></li>
                <li>Pilih format <strong>CSV (Comma delimited) (*.csv)</strong></li>
                <li>Simpan file dan upload di sini</li>
            </ol>
        </div>
    </div>
</x-admin-layout>
