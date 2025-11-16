<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Informasi Akun</h3>
                        <div class="space-x-2">
                            <a href="{{ route('admin.members.pending') }}" class="text-blue-600 hover:text-blue-800">← Kembali</a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Username</p>
                            <p class="font-medium">{{ $user->username }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-medium">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded text-xs
                                    @if($user->status === 'active') bg-green-100 text-green-800
                                    @elseif($user->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Role</p>
                            <p class="font-medium">{{ ucfirst($user->role) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tanggal Daftar</p>
                            <p class="font-medium">{{ $user->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    @if($user->status === 'pending')
                        <div class="mt-6 pt-6 border-t space-x-2">
                            <form action="{{ route('admin.members.approve', $user) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="return confirm('Setujui anggota ini?')">
                                    Setujui Anggota
                                </button>
                            </form>
                            <form action="{{ route('admin.members.reject', $user) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700" onclick="return confirm('Tolak anggota ini?')">
                                    Tolak Anggota
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            @if($user->dataPribadi)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Data Pribadi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Nama Lengkap</p>
                                <p class="font-medium">{{ $user->dataPribadi->nama_lengkap }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">NIPTK/NUPTK</p>
                                <p class="font-medium">{{ $user->dataPribadi->niptk_nuptk ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">No. KTP</p>
                                <p class="font-medium">{{ $user->dataPribadi->no_ktp }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Tempat, Tanggal Lahir</p>
                                <p class="font-medium">{{ $user->dataPribadi->tempat_lahir }}, {{ $user->dataPribadi->tanggal_lahir->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Jenis Kelamin</p>
                                <p class="font-medium">{{ $user->dataPribadi->jenis_kelamin }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">No. HP</p>
                                <p class="font-medium">{{ $user->dataPribadi->no_hp }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($user->dataLembaga)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Data Lembaga</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Nama PAUD/TK/KB</p>
                                <p class="font-medium">{{ $user->dataLembaga->nama_lembaga }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">NPSN</p>
                                <p class="font-medium">{{ $user->dataLembaga->npsn }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
