<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Verifikasi Pendaftar Baru</h2>
        <p class="text-gray-500 text-sm mt-1">Setujui pendaftar untuk mengaktifkan akun mereka (Pengganti Pembayaran).</p>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Menunggu Verifikasi</p>
                <p class="text-2xl font-bold text-orange-600">{{ $members->total() }} Orang</p>
            </div>
            <div class="p-3 bg-orange-50 rounded-full text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                            <th class="px-6 py-4">Nama Pendidik</th>
                            <th class="px-6 py-4">Lembaga / Sekolah</th>
                            <th class="px-6 py-4">Detail Info</th>
                            <th class="px-6 py-4">Status</th>
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
                                        NPSN: {{ $member->dataLembaga->npsn ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs text-gray-500 block">
                                        Email: {{ $member->email }}
                                    </span>
                                    <span class="text-xs text-gray-500 block">
                                        HP: {{ $member->dataPribadi->no_hp ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">
                                        Menunggu
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.members.show', $member) }}" 
                                       class="text-gray-500 hover:text-blue-600 text-sm font-medium underline">
                                        Lihat Detail
                                    </a>
                                    <form action="{{ route('admin.members.approve', $member) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded shadow-sm transition"
                                                onclick="return confirm('Setujui anggota ini?')">
                                            ✔ Aktifkan
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 text-lg font-medium">Tidak ada anggota yang menunggu persetujuan</p>
                <p class="text-gray-400 text-sm mt-2">Semua pendaftar sudah diverifikasi</p>
            </div>
        @endif
    </div>
</x-admin-layout>
