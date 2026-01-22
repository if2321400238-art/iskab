<?php

namespace App\Http\Controllers;

use App\Models\ProfilOrganisasi;
use App\Models\Korwil;
use App\Models\Rayon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function profil()
    {
        $profil = ProfilOrganisasi::first();
        return view('frontend.tentang-kami.profil', compact('profil'));
    }

    public function korwil(Request $request)
    {
        $korwils = Korwil::with('rayons')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->q;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('wilayah', 'like', "%{$search}%")
                        ->orWhere('nomor_sk', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('frontend.tentang-kami.korwil', compact('korwils'));
    }

    public function rayon(Request $request)
    {
        $rayons = Rayon::with('korwil')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->q;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('nomor_sk', 'like', "%{$search}%")
                        ->orWhereHas('korwil', function ($k) use ($search) {
                            $k->where('name', 'like', "%{$search}%")
                              ->orWhere('wilayah', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('frontend.tentang-kami.rayon', compact('rayons'));
    }
}
