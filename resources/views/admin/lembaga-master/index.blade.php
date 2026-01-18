<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Data Lembaga</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola data master lembaga (PAUD/TK/KB).</p>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <div class="flex gap-2">
                <a href="{{ route('admin.lembaga-master.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah</a>
                <a href="{{ route('admin.lembaga-master.import') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Import Excel
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif

        <form method="GET" class="mb-4">
            <div class="flex gap-2">
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama sekolah / NPSN" class="w-full border rounded px-3 py-2">
                <button class="px-4 py-2 bg-gray-800 text-white rounded">Cari</button>
            </div>
        </form>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Sekolah</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NPSN</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akreditasi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($items as $item)
                    <tr>
                        <td class="px-4 py-2">{{ $item->nama_sekolah }}</td>
                        <td class="px-4 py-2">{{ $item->npsn }}</td>
                        <td class="px-4 py-2">{{ $item->akreditasi ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->tahun_akreditasi ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->jumlah_guru ?? 0 }}</td>
                        <td class="px-4 py-2">{{ $item->jumlah_siswa ?? 0 }}</td>
                        <td class="px-4 py-2 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.lembaga-master.edit', $item) }}" class="px-3 py-1 text-sm bg-yellow-500 text-white rounded">Edit</a>
                                <form action="{{ route('admin.lembaga-master.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 text-sm bg-red-600 text-white rounded">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $items->links() }}</div>
    </div>
</x-admin-layout>
