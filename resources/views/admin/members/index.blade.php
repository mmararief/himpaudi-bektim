<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Data Anggota</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola dan lihat data seluruh anggota aktif HIMPAUDI Bekasi Timur.</p>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Anggota Aktif</p>
                <p class="text-2xl font-bold text-green-600">{{ $members->total() }} Orang</p>
            </div>
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        @if ($members->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 border-b border-gray-200 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Nama Anggota</th>
                            <th class="px-6 py-4">Lembaga / Sekolah</th>
                            <th class="px-6 py-4">Kontak</th>
                            <th class="px-6 py-4">Tanggal Bergabung</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($members as $member)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($member->dataPribadi && $member->dataPribadi->foto_profil)
                                            <img src="{{ asset('storage/'.$member->dataPribadi->foto_profil) }}" 
                                                 alt="Foto" 
                                                 class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-gray-200 flex-shrink-0"></div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ $member->dataPribadi->nama_lengkap ?? $member->username }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                NIK: {{ $member->dataPribadi->nik ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-900 text-sm">
                                        {{ $member->dataLembaga->nama_lembaga ?? '-' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $member->dataLembaga->kelurahan ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-900 text-sm">{{ $member->email }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $member->dataPribadi->no_hp ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">
                                        {{ $member->created_at->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.members.show', $member) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium underline">
                                        Lihat Detail
                                    </a>
                                    <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800 text-sm font-medium"
                                                onclick="return confirm('Hapus anggota ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 flex items-center justify-between">
                <span class="text-sm text-gray-500">
                    Menampilkan {{ $members->firstItem() ?? 0 }}-{{ $members->lastItem() ?? 0 }} dari {{ $members->total() }} data
                </span>
                <div class="flex gap-1">
                    {{ $members->links() }}
                </div>
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="text-gray-500 text-lg font-medium">Belum ada anggota aktif</p>
                <p class="text-gray-400 text-sm mt-2">Anggota yang disetujui akan muncul di sini</p>
            </div>
        @endif
    </div>
</x-admin-layout>
