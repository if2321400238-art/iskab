<?php

namespace App\Http\Controllers;

use App\Models\Korwil;
use App\Models\Rayon;
use App\Models\SKPengajuan;

class DataController extends Controller
{
    public function index()
    {
        $korwilCount = Korwil::count();
        $rayonCount = Rayon::count();

        return view('frontend.data', compact('korwilCount', 'rayonCount'));
    }

    public function skForm()
    {
        $korwils = Korwil::all();
        return view('frontend.sk-form', compact('korwils'));
    }

    public function storeSkForm()
    {
        $rules = [
            'nama_pemohon' => 'required|string|max:255',
            'email' => 'required|email',
            'nomor_hp' => 'required|string',
            'jenis_sk' => 'required|in:korwil,rayon',
            'nama_organisasi' => 'required|string|max:255',
            'wilayah' => 'required|string|max:255',
        ];

        // Add conditional validation for korwil_id
        if (request('jenis_sk') === 'rayon') {
            $rules['korwil_id'] = 'required|integer|exists:korwils,id';
        } else {
            $rules['korwil_id'] = 'nullable';
        }

        $validated = request()->validate($rules);

        SKPengajuan::create($validated);

        return redirect()->route('data.index')->with('success', 'SK berhasil diajukan. Tim BPH Pusat akan meninjau pengajuan Anda.');
    }
}
