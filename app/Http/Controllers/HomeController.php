<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use App\Models\Faq;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::active()->first();
        $faqs = Faq::active()->ordered()->get();
        $berita = Berita::published()->latest()->take(3)->get();

        // Parse misi into list items by lines/bullets if available
        $misiList = [];
        if ($visiMisi && $visiMisi->misi) {
            $lines = preg_split('/\r\n|\r|\n/', (string) $visiMisi->misi);
            foreach ($lines as $line) {
                $text = trim(preg_replace('/^[\-•\d\.)\s]+/', '', $line));
                if ($text !== '') {
                    $misiList[] = $text;
                }
            }
        }

        return view('welcome', [
            'visiMisi' => $visiMisi,
            'misiList' => $misiList,
            'faqs' => $faqs,
            'berita' => $berita,
        ]);
    }

    public function strukturOrganisasi()
    {
        return view('struktur-organisasi');
    }
}
