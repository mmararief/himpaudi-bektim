<?php

namespace App\Http\Controllers;

use App\Models\LembagaMaster;
use App\Models\User;
use Illuminate\Http\Request;

class PublicSiteController extends Controller
{
    public function search(Request $request)
    {
        $q = trim((string)$request->get('q', ''));
        $tab = $request->get('tab', 'lembaga'); // default: lembaga

        $lembaga = LembagaMaster::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama_sekolah', 'like', "%{$q}%")
                    ->orWhere('npsn', 'like', "%{$q}%")
                    ->orWhere('alamat', 'like', "%{$q}%");
            })
            ->orderBy('nama_sekolah')
            ->paginate(10, ['*'], 'lembaga_page')
            ->withQueryString();

        $anggota = User::query()
            ->active()
            ->with(['dataPribadi', 'dataLembaga'])
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('username', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                })
                    ->orWhereHas('dataPribadi', function ($qp) use ($q) {
                        $qp->where('nama_lengkap', 'like', "%{$q}%");
                    })
                    ->orWhereHas('dataLembaga', function ($ql) use ($q) {
                        $ql->where('nama_lembaga', 'like', "%{$q}%")
                            ->orWhere('npsn', 'like', "%{$q}%");
                    });
            })
            ->orderBy('username')
            ->paginate(10, ['*'], 'anggota_page')
            ->withQueryString();

        return view('public.search', compact('q', 'tab', 'lembaga', 'anggota'));
    }

    public function lembaga(LembagaMaster $lembaga_master)
    {
        $lembaga = $lembaga_master;

        $anggota = User::active()
            ->with(['dataPribadi', 'dataLembaga'])
            ->whereHas('dataLembaga', function ($q) use ($lembaga) {
                $q->where('npsn', $lembaga->npsn)
                    ->orWhere('lembaga_master_id', $lembaga->id);
            })
            ->orderBy('username')
            ->paginate(12)
            ->withQueryString();

        return view('public.lembaga.show', compact('lembaga', 'anggota'));
    }

    public function lembagaByNpsn($npsn)
    {
        $lembaga = LembagaMaster::where('npsn', $npsn)->firstOrFail();
        return $this->lembaga($lembaga);
    }

    public function profile(User $user)
    {
        // Only show active members
        if (!$user->isActive()) {
            abort(404);
        }

        $user->load(['dataPribadi', 'dataLembaga.lembagaMaster']);
        return view('public.profile.show', compact('user'));
    }
}
