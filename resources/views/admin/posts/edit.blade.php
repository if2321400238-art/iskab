@extends('layouts.admin')

@section('title', 'Edit Post - Admin ISKAB')
@section('page_title', 'Edit Post')

@section('content')
<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2">Tipe Post</label>
            <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('type') border-red-500 @enderror">
                <option value="berita" {{ $post->type === 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="pena_santri" {{ $post->type === 'pena_santri' ? 'selected' : '' }}>Pena Santri</option>
            </select>
            @error('type')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2">Judul</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('title') border-red-500 @enderror">
            @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2">Kategori</label>
            <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('category_id') border-red-500 @enderror">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2">Konten</label>
            <textarea name="content" rows="12" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('content') border-red-500 @enderror">{{ old('content', $post->content) }}</textarea>
            @error('content')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2">Thumbnail</label>
            @if($post->thumbnail)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-32 h-32 object-cover rounded-lg">
                </div>
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            <p class="text-gray-600 text-sm mt-1">Biarkan kosong jika tidak ingin mengubah</p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-semibold mb-2">Tanggal Publikasi</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="flex items-end">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_popular" value="1" {{ $post->is_popular ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300">
                    <span class="ml-2 text-sm font-semibold">Tandai sebagai Populer</span>
                </label>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">
                Update Post
            </button>
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 font-semibold">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
