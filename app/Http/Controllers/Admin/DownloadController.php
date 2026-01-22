<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::latest()->paginate(15);
        return view('admin.download.index', compact('downloads'));
    }

    public function create()
    {
        return view('admin.download.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_file' => 'required|string|max:255',
            'kategori' => 'required|in:logo,ad_art,administrasi,surat_template,panduan_lain',
            'deskripsi' => 'nullable|string',
            'file_path' => 'required|file|max:20000',
        ]);

        $validated['file_path'] = $request->file('file_path')->store('downloads', 'public');

        Download::create($validated);

        return redirect()->route('admin.download.index')->with('success', 'File berhasil diupload');
    }

    public function edit(Download $download)
    {
        return view('admin.download.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $validated = $request->validate([
            'nama_file' => 'required|string|max:255',
            'kategori' => 'required|in:logo,ad_art,administrasi,surat_template,panduan_lain',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|max:20000',
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('downloads', 'public');
        }

        $download->update($validated);

        return redirect()->route('admin.download.index')->with('success', 'File berhasil diperbarui');
    }

    public function destroy(Download $download)
    {
        $download->delete();
        return redirect()->route('admin.download.index')->with('success', 'File berhasil dihapus');
    }
}
