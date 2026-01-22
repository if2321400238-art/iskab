@extends('layouts.admin')

@section('title', 'Tambah File Download')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah File Download</h1>
        <a href="{{ route('admin.download.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Kembali</a>
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

    <form action="{{ route('admin.download.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama File</label>
            <input type="text" name="nama_file" value="{{ old('nama_file') }}" class="w-full border-gray-300 rounded" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="kategori" class="w-full border-gray-300 rounded" required>
                <option value="logo" {{ old('kategori') === 'logo' ? 'selected' : '' }}>Logo</option>
                <option value="ad_art" {{ old('kategori') === 'ad_art' ? 'selected' : '' }}>AD/ART</option>
                <option value="administrasi" {{ old('kategori') === 'administrasi' ? 'selected' : '' }}>Administrasi</option>
                <option value="surat_template" {{ old('kategori') === 'surat_template' ? 'selected' : '' }}>Template Surat</option>
                <option value="panduan_lain" {{ old('kategori') === 'panduan_lain' ? 'selected' : '' }}>Panduan Lain</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="w-full border-gray-300 rounded">{{ old('deskripsi') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">File</label>
            <input type="file" name="file_path" class="w-full border-gray-300 rounded" required>
            <p class="text-xs text-gray-500 mt-1">Maks 20MB.</p>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.download.index') }}" class="px-4 py-2 border rounded text-gray-700">Batal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
