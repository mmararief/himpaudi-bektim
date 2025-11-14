<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile (read-only view).
     */
    public function show(Request $request): View
    {
        $user = $request->user();
        $user->loadMissing(['dataPribadi', 'dataLembaga']);

        // Provide defaults if relations don't exist
        $dataPribadi = $user->dataPribadi ?? new \App\Models\DataPribadi([
            'nama_lengkap' => $user->username ?? '',
        ]);
        $dataLembaga = $user->dataLembaga ?? new \App\Models\DataLembaga([
            'nama_lembaga' => '',
            'kelurahan' => null,
            'kecamatan' => 'Bekasi Timur',
        ]);

        return view('profile.show', [
            'user' => $user,
            'dataPribadi' => $dataPribadi,
            'dataLembaga' => $dataLembaga,
        ]);
    }

    /**
     * Display the institution data page (read-only view).
     */
    public function showLembaga(Request $request): View
    {
        $user = $request->user();
        $user->loadMissing(['dataPribadi', 'dataLembaga']);

        // Provide defaults if relations don't exist
        $dataPribadi = $user->dataPribadi ?? new \App\Models\DataPribadi([
            'nama_lengkap' => $user->username ?? '',
        ]);
        $dataLembaga = $user->dataLembaga ?? new \App\Models\DataLembaga([
            'nama_lembaga' => '',
            'kelurahan' => null,
            'kecamatan' => 'Bekasi Timur',
        ]);

        return view('profile.lembaga', [
            'user' => $user,
            'dataPribadi' => $dataPribadi,
            'dataLembaga' => $dataLembaga,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Eager load relations but do not create DB records here to avoid
        // violating NOT NULL constraints in tests or for incomplete profiles.
        $user->loadMissing(['dataPribadi', 'dataLembaga']);

        // Provide unsaved model instances as defaults for the view
        $dataPribadi = $user->dataPribadi ?? new \App\Models\DataPribadi([
            'nama_lengkap' => $user->username ?? '',
        ]);
        $dataLembaga = $user->dataLembaga ?? new \App\Models\DataLembaga([
            'nama_lembaga' => '',
            'kelurahan' => null,
            'kecamatan' => 'Bekasi Timur',
        ]);

        return view('profile.edit', [
            'user' => $user,
            'dataPribadi' => $dataPribadi,
            'dataLembaga' => $dataLembaga,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update Data Pribadi for the authenticated user.
     */
    public function updateDataPribadi(\App\Http\Requests\DataPribadiUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        // Handle file upload if provided
        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $data['foto_profil'] = $path;
        }

        // Ensure array cast for riwayat_diklat
        if (!isset($data['riwayat_diklat'])) {
            $data['riwayat_diklat'] = [];
        }

        $user->dataPribadi()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return Redirect::route('profile.edit')->with('status', 'data-pribadi-updated');
    }

    /**
     * Update Data Lembaga for the authenticated user.
     */
    public function updateDataLembaga(\App\Http\Requests\DataLembagaUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        $user->dataLembaga()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return Redirect::route('profile.edit')->with('status', 'data-lembaga-updated');
    }
}
