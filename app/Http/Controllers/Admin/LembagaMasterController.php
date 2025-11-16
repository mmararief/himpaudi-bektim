<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\LembagaMastersImport;
use App\Models\LembagaMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LembagaMasterController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $items = LembagaMaster::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama_sekolah', 'like', "%{$q}%")
                    ->orWhere('npsn', 'like', "%{$q}%");
            })
            ->orderBy('nama_sekolah')
            ->paginate(15)
            ->withQueryString();

        return view('admin.lembaga-master.index', compact('items', 'q'));
    }

    public function create()
    {
        return view('admin.lembaga-master.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'npsn' => ['nullable', 'string', 'max:16'],
            'alamat' => ['nullable', 'string'],
            'nama_kepala_sekolah' => ['nullable', 'string', 'max:255'],
            'jumlah_guru' => ['nullable', 'integer', 'min:0'],
            'jumlah_siswa' => ['nullable', 'integer', 'min:0'],
            'akreditasi' => ['nullable', 'in:A,B,C,-'],
            'tahun_akreditasi' => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'foto_sekolah' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('foto_sekolah')) {
            $data['foto_sekolah'] = $request->file('foto_sekolah')->store('lembaga', 'public');
        }

        LembagaMaster::create($data);

        return redirect()->route('admin.lembaga-master.index')
            ->with('success', 'Data lembaga berhasil ditambahkan.');
    }

    public function edit(LembagaMaster $lembaga_master)
    {
        return view('admin.lembaga-master.edit', ['item' => $lembaga_master]);
    }

    public function update(Request $request, LembagaMaster $lembaga_master)
    {
        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'npsn' => ['nullable', 'string', 'max:16'],
            'alamat' => ['nullable', 'string'],
            'nama_kepala_sekolah' => ['nullable', 'string', 'max:255'],
            'jumlah_guru' => ['nullable', 'integer', 'min:0'],
            'jumlah_siswa' => ['nullable', 'integer', 'min:0'],
            'akreditasi' => ['nullable', 'in:A,B,C,-'],
            'tahun_akreditasi' => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'foto_sekolah' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('foto_sekolah')) {
            if ($lembaga_master->foto_sekolah) {
                Storage::disk('public')->delete($lembaga_master->foto_sekolah);
            }
            $data['foto_sekolah'] = $request->file('foto_sekolah')->store('lembaga', 'public');
        }

        $lembaga_master->update($data);

        return redirect()->route('admin.lembaga-master.index')
            ->with('success', 'Data lembaga berhasil diperbarui.');
    }

    public function destroy(LembagaMaster $lembaga_master)
    {
        if ($lembaga_master->foto_sekolah) {
            Storage::disk('public')->delete($lembaga_master->foto_sekolah);
        }
        $lembaga_master->delete();

        return back()->with('success', 'Data lembaga berhasil dihapus.');
    }

    public function import()
    {
        return view('admin.lembaga-master.import');
    }

    public function processImport(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv', 'max:10240'],
        ]);

        try {
            $import = new LembagaMastersImport();
            $filePath = $request->file('file')->getRealPath();

            $import->import($filePath);

            $message = sprintf(
                'Import selesai! Data baru: %d, Diperbarui: %d, Dilewati: %d, Error: %d',
                $import->getImported(),
                $import->getUpdated(),
                $import->getSkipped(),
                count($import->getErrors())
            );

            if (count($import->getErrors()) > 0) {
                return back()->with('warning', $message)->with('errors', $import->getErrors());
            }

            return redirect()->route('admin.lembaga-master.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
