<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MemberApproved;
use App\Mail\MemberRejected;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MemberController extends Controller
{
    /**
     * Display pending members awaiting approval
     */
    public function pending()
    {
        $members = User::pending()->member()->latest()->paginate(20);

        return view('admin.members.pending', compact('members'));
    }

    /**
     * Display all active members
     */
    public function index()
    {
        $members = User::active()->member()->latest()->paginate(20);

        return view('admin.members.index', compact('members'));
    }

    /**
     * Display rejected members
     */
    public function rejected()
    {
        $members = User::rejected()->member()->latest()->paginate(20);

        return view('admin.members.rejected', compact('members'));
    }

    /**
     * Approve a pending member
     */
    public function approve(User $user)
    {
        if ($user->status !== 'pending') {
            return back()->with('error', 'Hanya anggota dengan status pending yang dapat disetujui.');
        }

        $user->update(['status' => 'active']);

        // Send email notification to user
        Mail::to($user->email)->send(new MemberApproved($user));

        return back()->with('success', 'Anggota berhasil disetujui dan email notifikasi telah dikirim!');
    }

    /**
     * Reject a pending member
     */
    public function reject(User $user)
    {
        if ($user->status !== 'pending') {
            return back()->with('error', 'Hanya anggota dengan status pending yang dapat ditolak.');
        }

        $user->update(['status' => 'rejected']);

        // Send email notification to user
        Mail::to($user->email)->send(new MemberRejected($user));

        return back()->with('success', 'Anggota berhasil ditolak dan email notifikasi telah dikirim!');
    }

    /**
     * Show member details
     */
    public function show(User $user)
    {
        $user->load(['dataPribadi', 'dataLembaga']);

        return view('admin.members.show', compact('user'));
    }

    /**
     * Delete a member
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        $user->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}
