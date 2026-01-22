@extends('layouts.admin')

@section('title', 'Galeri')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Galeri</h1>
            <p class="text-sm text-gray-500">Kelola foto dan video dokumentasi.</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah</a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" class="mb-4 flex items-center gap-3">
        <select name="type" class="border-gray-300 rounded" onchange="this.form.submit()">
            <option value="">Semua Tipe</option>
            <option value="photo" {{ request('type') === 'photo' ? 'selected' : '' }}>Foto</option>
            <option value="video" {{ request('type') === 'video' ? 'selected' : '' }}>Video</option>
        </select>
        @if(request()->has('type') && request('type') !== '')
            <a href="{{ route('admin.gallery.index') }}" class="text-sm text-gray-600">Reset</a>
        @endif
    </form>

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($galleries as $gallery)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-900">{{ $gallery->title }}</div>
                            <div class="text-xs text-gray-500">{{ Str::limit($gallery->description, 80) }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded {{ $gallery->type === 'photo' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">{{ ucfirst($gallery->type) }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $gallery->kegiatan ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $gallery->tahun ?? '-' }}</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <a href="{{ route('admin.gallery.edit', $gallery) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada data galeri</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $galleries->withQueryString()->links() }}
    </div>
</div>
@endsection
