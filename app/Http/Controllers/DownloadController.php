<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::latest()->paginate(15);
        $kategoris = Download::distinct()->pluck('kategori');

        return view('frontend.download', compact('downloads', 'kategoris'));
    }

    public function download(Download $download)
    {
        // Use public disk to match storage:link path
        if (!Storage::disk('public')->exists($download->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan. Silakan hubungi administrator.');
        }

        $download->incrementDownloadCount();

        return Storage::disk('public')->download($download->file_path, $download->nama_file);
    }
}
