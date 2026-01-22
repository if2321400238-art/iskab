<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rayon;
use App\Models\Korwil;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    public function index(Request $request)
    {
        $query = Rayon::with('korwil');

        if ($request->has('korwil') && $request->korwil) {
            $query->where('korwil_id', $request->korwil);
        }

        $rayons = $query->latest()->paginate(15);
        $korwils = Korwil::all();

        return view('admin.rayon.index', compact('rayons', 'korwils'));
    }

    public function create()
    {
        $korwils = Korwil::all();
        return view('admin.rayon.create', compact('korwils'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'korwil_id' => 'required|exists:korwils,id',
            'nomor_sk' => 'nullable|string',
            'tanggal_sk' => 'nullable|date',
            'description' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);

        Rayon::create($validated);

        return redirect()->route('admin.rayon.index')->with('success', 'Rayon berhasil ditambahkan');
    }

    public function edit(Rayon $rayon)
    {
        $korwils = Korwil::all();
        return view('admin.rayon.edit', compact('rayon', 'korwils'));
    }

    public function update(Request $request, Rayon $rayon)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'korwil_id' => 'required|exists:korwils,id',
            'nomor_sk' => 'nullable|string',
            'tanggal_sk' => 'nullable|date',
            'description' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);

        $rayon->update($validated);

        return redirect()->route('admin.rayon.index')->with('success', 'Rayon berhasil diperbarui');
    }

    public function destroy(Rayon $rayon)
    {
        $rayon->delete();
        return redirect()->route('admin.rayon.index')->with('success', 'Rayon berhasil dihapus');
    }

    /**
     * API sederhana untuk dropdown rayon berdasarkan korwil.
     */
    public function listByKorwil($korwilId)
    {
        $rayons = Rayon::where('korwil_id', $korwilId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($rayons);
    }
}
