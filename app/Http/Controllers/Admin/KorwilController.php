<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Korwil;
use Illuminate\Http\Request;

class KorwilController extends Controller
{
    public function index()
    {
        $korwils = Korwil::with('rayons')->latest()->paginate(15);
        return view('admin.korwil.index', compact('korwils'));
    }

    public function create()
    {
        return view('admin.korwil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wilayah' => 'required|string|max:255',
            'nomor_sk' => 'nullable|string',
            'tanggal_sk' => 'nullable|date',
            'description' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);

        Korwil::create($validated);

        return redirect()->route('admin.korwil.index')->with('success', 'Korwil berhasil ditambahkan');
    }

    public function edit(Korwil $korwil)
    {
        return view('admin.korwil.edit', compact('korwil'));
    }

    public function update(Request $request, Korwil $korwil)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wilayah' => 'required|string|max:255',
            'nomor_sk' => 'nullable|string',
            'tanggal_sk' => 'nullable|date',
            'description' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);

        $korwil->update($validated);

        return redirect()->route('admin.korwil.index')->with('success', 'Korwil berhasil diperbarui');
    }

    public function destroy(Korwil $korwil)
    {
        $korwil->delete();
        return redirect()->route('admin.korwil.index')->with('success', 'Korwil berhasil dihapus');
    }
}
