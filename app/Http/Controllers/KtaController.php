<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class KtaController extends Controller
{
    public function cetak()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->loadMissing(['dataPribadi', 'dataLembaga']);

        $pdf = Pdf::loadView('pdf.kta', [
            'user' => $user,
            'dataPribadi' => $user->dataPribadi,
            'dataLembaga' => $user->dataLembaga,
        ]);

        // Set paper size Landscape Fix
        $pdf->setPaper([0, 0, 480, 295], 'portrait');

        $filename = 'KTA-' . ($user->dataPribadi->nama_lengkap ?? $user->username) . '.pdf';
        return $pdf->stream($filename);
    }

    public function download()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->loadMissing(['dataPribadi', 'dataLembaga']);

        $pdf = Pdf::loadView('pdf.kta', [
            'user' => $user,
            'dataPribadi' => $user->dataPribadi,
            'dataLembaga' => $user->dataLembaga,
        ]);

        // Set paper size Landscape Fix
        $pdf->setPaper([0, 0, 480, 295], 'portrait');

        $filename = 'KTA-' . ($user->dataPribadi->nama_lengkap ?? $user->username) . '.pdf';
        return $pdf->download($filename);
    }
}
