@extends('layouts.app')

@section('title', 'Beranda - ISKAB')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-700 text-white py-32 overflow-hidden">
    <!-- Background pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=%2760%27 height=%2760%27 viewBox=%270 0 60 60%27 xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cg fill=%27none%27 fill-rule=%27evenodd%27%3E%3Cg fill=%27white%27 fill-opacity=%270.1%27%3E%3Cpath d=%27M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%27/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="inline-block bg-white bg-opacity-20 px-4 py-2 rounded-full mb-4">
            <span class="text-sm font-semibold">OFFICIAL ORGANIZATION</span>
        </div>
        <h2 class="text-5xl md:text-6xl font-bold mb-4">Website Resmi Ikatan Santri Kalimantan Barat (ISKAB)</h2>
        <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">"Pondokmu adalah pondokku, Gurumu adalah guruku"</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('about.profil') }}" class="px-8 py-3 bg-white text-green-600 rounded-lg font-semibold hover:bg-gray-100 transition">Tentang Kami</a>
            <a href="{{ route('posts.berita') }}" class="px-8 py-3 bg-green-800 text-white rounded-lg font-semibold hover:bg-green-900 transition">Baca Berita</a>
        </div>
    </div>
</section>

<!-- Info & Stats Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Logo & Deskripsi -->
            <div class="order-2 lg:order-1">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang ISKAB</h2>
                @if($profil)
                    <p class="text-gray-700 leading-relaxed mb-4">{{ $profil->sejarah ?? 'Belum ada deskripsi organisasi.' }}</p>
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="bg-green-50 p-4 rounded">
                            <h3 class="text-lg font-semibold text-green-600 mb-2">Visi</h3>
                            <p class="text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($profil->visi ?? '', 100) }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded">
                            <h3 class="text-lg font-semibold text-green-600 mb-2">Misi</h3>
                            <p class="text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($profil->misi ?? '', 100) }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">Belum ada profil organisasi.</p>
                @endif
            </div>

            <!-- Statistics Grid -->
            <div class="order-1 lg:order-2">
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-lg border-l-4 border-blue-500 text-center">
                        <div class="text-4xl md:text-5xl font-bold text-blue-600">{{ $stats['korwil'] }}</div>
                        <div class="text-sm md:text-base font-semibold text-blue-700 mt-2 uppercase tracking-wide">Korwil</div>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-lg border-l-4 border-green-500 text-center">
                        <div class="text-4xl md:text-5xl font-bold text-green-600">{{ $stats['rayon'] }}</div>
                        <div class="text-sm md:text-base font-semibold text-green-700 mt-2 uppercase tracking-wide">Rayon</div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-lg border-l-4 border-purple-500 text-center">
                        <div class="text-4xl md:text-5xl font-bold text-purple-600">{{ $stats['anggota'] }}</div>
                        <div class="text-sm md:text-base font-semibold text-purple-700 mt-2 uppercase tracking-wide">Santri</div>
                    </div>
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-8 rounded-lg border-l-4 border-orange-500 text-center">
                        <div class="text-4xl md:text-5xl font-bold text-orange-600">{{ $stats['sk_approved'] }}</div>
                        <div class="text-sm md:text-base font-semibold text-orange-700 mt-2 uppercase tracking-wide">SK Approved</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Berita Populer -->
    <section class="mb-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Berita Populer</h2>
            <a href="{{ route('posts.berita') }}" class="text-green-600 hover:text-green-700 font-semibold">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritaPopuler as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition transform hover:-translate-y-1">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300"></div>
                    @endif
                    <div class="p-6">
                        <div class="text-xs text-green-600 font-semibold mb-2 uppercase">{{ $post->category->name ?? 'Uncategorized' }}</div>
                        <div class="text-sm text-gray-500 mb-2">{{ $post->published_at?->format('d M Y') }}</div>
                        <h3 class="text-lg font-bold mb-2 line-clamp-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-green-600">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-2">{{ strip_tags($post->content) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-xs text-gray-500">👁️ {{ $post->view_count ?? 0 }} views</span>
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-green-600 hover:text-green-700 font-semibold text-sm">Baca →</a>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-gray-500 col-span-full">Belum ada berita populer</p>
            @endforelse
        </div>
    </section>

    <!-- Berita Terkini -->
    <section class="mb-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Berita Terkini</h2>
            <a href="{{ route('posts.berita') }}" class="text-green-600 hover:text-green-700 font-semibold">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritaTerkini as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition transform hover:-translate-y-1">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300"></div>
                    @endif
                    <div class="p-6">
                        <div class="text-xs text-green-600 font-semibold mb-2 uppercase">{{ $post->category->name ?? 'Uncategorized' }}</div>
                        <div class="text-sm text-gray-500 mb-2">{{ $post->published_at?->format('d M Y') }}</div>
                        <h3 class="text-lg font-bold mb-2 line-clamp-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-green-600">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-2">{{ strip_tags($post->content) }}</p>
                        <div class="mt-4">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-green-600 hover:text-green-700 font-semibold text-sm">Baca →</a>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-gray-500 col-span-full">Belum ada berita terkini</p>
            @endforelse
        </div>
    </section>

    <!-- Pena Santri Highlight -->
    <section class="mb-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Pena Santri</h2>
            <a href="{{ route('posts.pena-santri') }}" class="text-green-600 hover:text-green-700 font-semibold">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($penaSantriHighlight as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition transform hover:-translate-y-1">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-orange-200 to-orange-300"></div>
                    @endif
                    <div class="p-6">
                        <div class="text-xs text-orange-600 font-semibold mb-2 uppercase">Opini Santri</div>
                        <div class="text-sm text-gray-500 mb-2">{{ $post->published_at?->format('d M Y') }}</div>
                        <h3 class="text-lg font-bold mb-2 line-clamp-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-green-600">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-2">{{ strip_tags($post->content) }}</p>
                        <div class="mt-4">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-green-600 hover:text-green-700 font-semibold text-sm">Baca →</a>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-gray-500 col-span-full">Belum ada artikel pena santri</p>
            @endforelse
        </div>
    </section>

    <!-- Dokumentasi -->
    <section class="mb-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Dokumentasi Kegiatan</h2>
            <a href="{{ route('gallery.index') }}" class="text-green-600 hover:text-green-700 font-semibold">Lihat Galeri →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($dokumentasi as $item)
                <a href="{{ route('gallery.show', $item) }}" class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition">
                    @if($item->type === 'photo' && $item->file_path)
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" class="w-full h-40 object-cover group-hover:scale-110 transition">
                    @else
                        <div class="w-full h-40 bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                            <span class="text-white">{{ $item->type === 'video' ? '🎬' : '📷' }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition flex items-center justify-center">
                        <span class="text-white font-semibold opacity-0 group-hover:opacity-100 transition">Lihat</span>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 col-span-full">Belum ada dokumentasi</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
