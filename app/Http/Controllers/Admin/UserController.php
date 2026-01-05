<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DataPribadi;
use App\Models\DataLembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of all users
     */
    public function index(Request $request)
    {
        $query = User::with(['dataPribadi', 'dataLembaga']);

        // Filter by role
        if ($request->has('role') && in_array($request->role, ['admin', 'member'])) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && in_array($request->status, ['pending', 'active', 'rejected'])) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('dataPribadi', function ($subQ) use ($search) {
                        $subQ->where('nama_lengkap', 'like', "%{$search}%");
                    });
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,member'],
            'status' => ['required', 'in:pending,active,rejected'],

            // Data Pribadi
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'niptk_nuptk' => ['nullable', 'string', 'max:20'],
            'no_ktp' => ['required', 'string', 'max:16'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'pendidikan_terakhir' => ['required', 'string', 'max:255'],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'gaji' => ['nullable', 'numeric'],
            'tmt_kerja' => ['required', 'date'],
            'riwayat_diklat' => ['nullable', 'json'],
            'alamat_domisili' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:15'],
            'foto_profil' => ['nullable', 'string'],
        ]);

        // Create user
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        // Create Data Pribadi
        DataPribadi::create([
            'user_id' => $user->id,
            'nama_lengkap' => $validated['nama_lengkap'],
            'niptk_nuptk' => $validated['niptk_nuptk'] ?? null,
            'no_ktp' => $validated['no_ktp'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
            'jurusan' => $validated['jurusan'] ?? null,
            'gaji' => $validated['gaji'] ?? null,
            'tmt_kerja' => $validated['tmt_kerja'],
            'riwayat_diklat' => $validated['riwayat_diklat'] ?? null,
            'alamat_domisili' => $validated['alamat_domisili'],
            'no_hp' => $validated['no_hp'],
            'foto_profil' => $validated['foto_profil'] ?? null,
        ]);

        // Create empty Data Lembaga for member
        if ($validated['role'] === 'member') {
            DataLembaga::create([
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        $user->load(['dataPribadi', 'dataLembaga']);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,member'],
            'status' => ['required', 'in:pending,active,rejected'],

            // Data Pribadi
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'niptk_nuptk' => ['nullable', 'string', 'max:20'],
            'no_ktp' => ['required', 'string', 'max:16'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'pendidikan_terakhir' => ['required', 'string', 'max:255'],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'gaji' => ['nullable', 'numeric'],
            'tmt_kerja' => ['required', 'date'],
            'riwayat_diklat' => ['nullable', 'json'],
            'alamat_domisili' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:15'],
            'foto_profil' => ['nullable', 'string'],

            // Data Lembaga
            'nama_lembaga' => ['nullable', 'string', 'max:255'],
            'npsn' => ['nullable', 'string', 'max:20'],
            'email_lembaga' => ['nullable', 'email', 'max:255'],
            'no_telp_lembaga' => ['nullable', 'string', 'max:15'],
            'provinsi' => ['nullable', 'string', 'max:255'],
            'kabupaten_kota' => ['nullable', 'string', 'max:255'],
            'kecamatan' => ['nullable', 'string', 'max:255'],
            'kelurahan' => ['nullable', 'string', 'max:255'],
            'alamat_lembaga' => ['nullable', 'string'],
        ]);

        // Update user
        $userData = [
            'username' => $validated['username'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ];

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        // Update Data Pribadi
        $user->dataPribadi()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap' => $validated['nama_lengkap'],
                'niptk_nuptk' => $validated['niptk_nuptk'] ?? null,
                'no_ktp' => $validated['no_ktp'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
                'jurusan' => $validated['jurusan'] ?? null,
                'gaji' => $validated['gaji'] ?? null,
                'tmt_kerja' => $validated['tmt_kerja'],
                'riwayat_diklat' => $validated['riwayat_diklat'] ?? null,
                'alamat_domisili' => $validated['alamat_domisili'],
                'no_hp' => $validated['no_hp'],
                'foto_profil' => $validated['foto_profil'] ?? null,
            ]
        );

        // Update Data Lembaga if member
        if ($validated['role'] === 'member') {
            $user->dataLembaga()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lembaga' => $validated['nama_lembaga'] ?? null,
                    'npsn' => $validated['npsn'] ?? null,
                    'email_lembaga' => $validated['email_lembaga'] ?? null,
                    'no_telp_lembaga' => $validated['no_telp_lembaga'] ?? null,
                    'provinsi' => $validated['provinsi'] ?? null,
                    'kabupaten_kota' => $validated['kabupaten_kota'] ?? null,
                    'kecamatan' => $validated['kecamatan'] ?? null,
                    'kelurahan' => $validated['kelurahan'] ?? null,
                    'alamat_lembaga' => $validated['alamat_lembaga'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        // Prevent deleting current logged in admin
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
