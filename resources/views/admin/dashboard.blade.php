@extends('layouts.admin')

@section('title', 'Dashboard Admin - ISKAB')
@section('page_title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
    <!-- Stats Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-4xl mb-2">📰</div>
        <h3 class="text-gray-600 text-sm font-semibold">Total Posts</h3>
        <p class="text-3xl font-bold text-green-600">{{ \App\Models\Post::count() }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-4xl mb-2">👥</div>
        <h3 class="text-gray-600 text-sm font-semibold">Total Anggota</h3>
        <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Anggota::count() }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-4xl mb-2">🗺️</div>
        <h3 class="text-gray-600 text-sm font-semibold">Total Korwil</h3>
        <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Korwil::count() }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-4xl mb-2">⏳</div>
        <h3 class="text-gray-600 text-sm font-semibold">SK Pending</h3>
        <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\SKPengajuan::where('status', 'pending')->count() }}</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Quick Actions</h2>
        <div class="space-y-3">
            <a href="{{ route('admin.posts.create') }}" class="block px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 text-center font-semibold">
                ➕ Buat Post Baru
            </a>
            <a href="{{ route('admin.anggota.create') }}" class="block px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center font-semibold">
                ➕ Tambah Anggota
            </a>
            <a href="{{ route('admin.gallery.create') }}" class="block px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-center font-semibold">
                ➕ Upload Galeri
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Informasi Sistem</h2>
        <div class="space-y-2 text-sm text-gray-600">
            <p><strong>Role Anda:</strong> {{ auth()->user()->role?->name ?? 'User' }}</p>
            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Bergabung:</strong> {{ auth()->user()->created_at->format('d F Y') }}</p>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Post Terbaru</h2>
        <div class="space-y-4">
            @forelse(\App\Models\Post::latest()->take(5)->get() as $post)
                <div class="border-b pb-4 last:border-b-0">
                    <h3 class="font-semibold text-gray-900">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-600">Oleh: {{ $post->author->name }}</p>
                    <p class="text-xs text-gray-500">{{ $post->created_at->format('d M Y H:i') }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada posts</p>
            @endforelse
        </div>
    </div>

    @if(auth()->user()->role?->slug === 'bph_pb')
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">SK Pengajuan Pending</h2>
            <div class="space-y-4">
                @forelse(\App\Models\SKPengajuan::where('status', 'pending')->latest()->take(5)->get() as $sk)
                    <div class="border-b pb-4 last:border-b-0">
                        <h3 class="font-semibold text-gray-900">{{ $sk->nama }}</h3>
                        <p class="text-sm text-gray-600">Tipe: {{ ucfirst($sk->tipe) }}</p>
                        <p class="text-xs text-gray-500">{{ $sk->created_at->format('d M Y H:i') }}</p>
                        <a href="{{ route('admin.sk-pengajuan.show', $sk) }}" class="text-xs text-green-600 hover:text-green-700 font-semibold mt-2 inline-block">
                            Review →
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500">Tidak ada SK pending</p>
                @endforelse
            </div>
        </div>
    @endif
</div>
@endsection
