@extends('layouts.admin')

@section('title', 'Download')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Download</h1>
            <p class="text-sm text-gray-500">Kelola file yang dapat diunduh.</p>
        </div>
        <a href="{{ route('admin.download.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah</a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama File</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unduhan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($downloads as $download)
                    <tr>
                        <td class="px-4 py-3 font-semibold text-gray-900">{{ $download->nama_file }}</td>
                        <td class="px-4 py-3">
                            @php
                                $colors = [
                                    'logo' => 'bg-blue-100 text-blue-700',
                                    'ad_art' => 'bg-green-100 text-green-700',
                                    'administrasi' => 'bg-yellow-100 text-yellow-700',
                                    'surat_template' => 'bg-purple-100 text-purple-700',
                                    'panduan_lain' => 'bg-gray-100 text-gray-700',
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs rounded {{ $colors[$download->kategori] ?? 'bg-gray-100 text-gray-700' }}">{{ str_replace('_', ' ', ucfirst($download->kategori)) }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ \Illuminate\Support\Str::limit($download->deskripsi, 80) }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $download->download_count ?? 0 }}</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <a href="{{ route('admin.download.edit', $download) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                            <form action="{{ route('admin.download.destroy', $download) }}" method="POST" onsubmit="return confirm('Hapus file ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada file</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $downloads->links() }}
    </div>
</div>
@endsection
