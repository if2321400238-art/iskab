<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Korwil;
use App\Models\Rayon;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::with('rayon', 'korwil');

        if ($request->has('korwil') && $request->korwil) {
            $query->where('korwil_id', $request->korwil);
        }

        if ($request->has('rayon') && $request->rayon) {
            $query->where('rayon_id', $request->rayon);
        }

        $anggota = $query->latest()->paginate(15);
        $korwils = Korwil::all();

        return view('admin.anggota.index', compact('anggota', 'korwils'));
    }

    public function create()
    {
        $korwils = Korwil::all();
        return view('admin.anggota.create', compact('korwils'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_anggota' => 'required|unique:anggota|string',
            'alamat' => 'nullable|string',
            'pondok' => 'nullable|string|max:255',
            'korwil_id' => 'required|exists:korwils,id',
            'rayon_id' => 'required|exists:rayons,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        $anggota = Anggota::create($validated);

        // Generate KTA
        // TODO: Implement KTA generation

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit(Anggota $anggota)
    {
        $korwils = Korwil::all();
        $rayons = Rayon::where('korwil_id', $anggota->korwil_id)->get();

        return view('admin.anggota.edit', compact('anggota', 'korwils', 'rayons'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_anggota' => 'required|unique:anggota,nomor_anggota,' . $anggota->id . '|string',
            'alamat' => 'nullable|string',
            'pondok' => 'nullable|string|max:255',
            'korwil_id' => 'required|exists:korwils,id',
            'rayon_id' => 'required|exists:rayons,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        $anggota->update($validated);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil diperbarui');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus');
    }

    public function downloadKTA(Anggota $anggota)
    {
        // TODO: Implement KTA download
        return back();
    }
}
