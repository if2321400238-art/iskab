<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        $galleries = $query->latest()->paginate(15);

        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:photo,video',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov|max:50000',
            'embed_url' => 'nullable|url',
            'kegiatan' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:2000|max:' . date('Y'),
        ]);

        if ($validated['type'] === 'photo' && $request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('galleries/photos', 'public');
        } elseif ($validated['type'] === 'video' && $request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('galleries/videos', 'public');
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'type' => 'required|in:photo,video',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov|max:50000',
            'embed_url' => 'nullable|url',
            'kegiatan' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:2000|max:' . date('Y'),
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('galleries/' . $validated['type'] . 's', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil dihapus');
    }
}
