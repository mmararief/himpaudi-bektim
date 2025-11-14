<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Anggota Ditolak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Daftar Anggota Ditolak ({{ $members->total() }})</h3>
                        <div class="space-x-2">
                            <a href="{{ route('admin.members.pending') }}" class="text-blue-600 hover:text-blue-800">Anggota Pending</a>
                            <span class="text-gray-400">|</span>
                            <a href="{{ route('admin.members.index') }}" class="text-blue-600 hover:text-blue-800">Anggota Aktif</a>
                        </div>
                    </div>

                    @if ($members->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Ditolak</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($members as $member)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->username }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->updated_at->format('d M Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                                <a href="{{ route('admin.members.show', $member) }}" class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
                                                <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Hapus anggota ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $members->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Tidak ada anggota yang ditolak.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
