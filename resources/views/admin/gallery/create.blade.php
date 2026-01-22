@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Galeri</h1>
        <a href="{{ route('admin.gallery.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
            <select name="type" class="w-full border-gray-300 rounded" required>
                <option value="photo" {{ old('type') === 'photo' ? 'selected' : '' }}>Foto</option>
                <option value="video" {{ old('type') === 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full border-gray-300 rounded">{{ old('description') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">File (foto/video)</label>
            <input type="file" name="file_path" class="w-full border-gray-300 rounded">
            <p class="text-xs text-gray-500 mt-1">Untuk video, opsional bisa pakai embed URL.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Embed URL (video)</label>
            <input type="url" name="embed_url" value="{{ old('embed_url') }}" class="w-full border-gray-300 rounded">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kegiatan</label>
                <input type="text" name="kegiatan" value="{{ old('kegiatan') }}" class="w-full border-gray-300 rounded">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <input type="number" name="tahun" value="{{ old('tahun') }}" class="w-full border-gray-300 rounded" min="2000" max="{{ date('Y') }}">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.gallery.index') }}" class="px-4 py-2 border rounded text-gray-700">Batal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
