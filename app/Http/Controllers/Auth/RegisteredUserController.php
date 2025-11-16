<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // User Account
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Data Pribadi
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'niptk_nuptk' => ['nullable', 'string', 'max:20', 'unique:data_pribadi'],
            'no_kta_lama' => ['nullable', 'string', 'max:50'],
            'no_ktp' => ['required', 'string', 'max:16', 'unique:data_pribadi'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'pendidikan_terakhir' => ['required', 'string', 'max:50'],
            'tmt_kerja' => ['required', 'date'],
            'riwayat_diklat' => ['nullable', 'array'],
            'alamat_domisili' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:15'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],

            // Data Lembaga
            'nama_lembaga' => ['required', 'string', 'max:255'],
            'npsn' => ['required', 'string', 'max:8'],
        ]);

        // Create User Account
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'member',
            'status' => 'pending',
        ]);

        // Upload foto profil if exists
        $fotoPath = null;
        if ($request->hasFile('foto_profil')) {
            $fotoPath = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        // Create Data Pribadi
        $user->dataPribadi()->create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'niptk_nuptk' => $validated['niptk_nuptk'],
            'no_kta_lama' => $validated['no_kta_lama'] ?? null,
            'no_ktp' => $validated['no_ktp'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
            'tmt_kerja' => $validated['tmt_kerja'],
            'riwayat_diklat' => $validated['riwayat_diklat'] ?? [],
            'alamat_domisili' => $validated['alamat_domisili'],
            'no_hp' => $validated['no_hp'],
            'foto_profil' => $fotoPath,
        ]);

        // Upload foto sekolah if exists
        $fotoSekolahPath = null;
        if ($request->hasFile('foto_sekolah')) {
            $fotoSekolahPath = $request->file('foto_sekolah')->store('sekolah', 'public');
        }

        // Create Data Lembaga
        $user->dataLembaga()->create([
            'nama_lembaga' => $validated['nama_lembaga'],
            'npsn' => $validated['npsn'],
        ]);

        event(new Registered($user));

        // Do NOT auto-login - user must wait for admin approval
        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil! Akun Anda menunggu persetujuan dari admin. Silakan tunggu notifikasi email.');
    }
}
