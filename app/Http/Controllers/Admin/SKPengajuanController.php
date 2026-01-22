<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SKPengajuan;
use App\Models\Korwil;
use App\Models\Rayon;
use Illuminate\Http\Request;

class SKPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = SKPengajuan::with('submittedBy', 'approvedBy', 'korwil', 'rayon');

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('tipe') && $request->tipe) {
            $query->where('tipe', $request->tipe);
        }

        $pengajuan = $query->latest()->paginate(15);

        return view('admin.sk-pengajuan.index', compact('pengajuan'));
    }

    public function show(SKPengajuan $pengajuan)
    {
        return view('admin.sk-pengajuan.show', compact('pengajuan'));
    }

    public function approve(Request $request, SKPengajuan $pengajuan)
    {
        $pengajuan->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        // Update nomor SK ke korwil/rayon
        if ($pengajuan->tipe === 'korwil') {
            $pengajuan->korwil->update([
                'nomor_sk' => $pengajuan->nama,
                'tanggal_sk' => now()->toDateString(),
            ]);
        } else {
            $pengajuan->rayon->update([
                'nomor_sk' => $pengajuan->nama,
                'tanggal_sk' => now()->toDateString(),
            ]);
        }

        return redirect()->back()->with('success', 'SK berhasil disetujui');
    }

    public function revise(Request $request, SKPengajuan $pengajuan)
    {
        $validated = $request->validate([
            'catatan_revisi' => 'required|string',
        ]);

        $pengajuan->update([
            'status' => 'revised',
            'catatan_revisi' => $validated['catatan_revisi'],
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Revisi berhasil dikirim');
    }

    public function reject(Request $request, SKPengajuan $pengajuan)
    {
        $validated = $request->validate([
            'catatan_revisi' => 'required|string',
        ]);

        $pengajuan->update([
            'status' => 'rejected',
            'catatan_revisi' => $validated['catatan_revisi'],
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Pengajuan ditolak');
    }
}
