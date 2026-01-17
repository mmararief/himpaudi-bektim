<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
            Tambah Berita
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-50 text-green-700 border border-green-200">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-4">
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari judul..." class="w-full md:w-64 px-3 py-2 border rounded-lg" />
    </form>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Thumbnail</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Judul</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Dipublikasikan</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($berita as $item)
                    <tr>
                        <td class="px-4 py-3">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="thumb" class="w-16 h-12 object-cover rounded" />
                            @else
                                <div class="w-16 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-xs">No Img</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $item->judul }}</div>
                            <div class="text-xs text-gray-500">/{{ $item->slug }}</div>
                        </td>
                        <td class="px-4 py-3">
                            @if($item->is_published)
                                <span class="px-2 py-1 text-xs rounded bg-green-50 text-green-700">Published</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">Draft</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($item->published_at)->format('d M Y H:i') ?? '-' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.berita.edit', $item) }}" class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada berita</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $berita->links() }}</div>
</x-admin-layout>
