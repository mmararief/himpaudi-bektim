<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contacts = ContactInfo::latest()->get();
        return view('admin.contact-info.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contact-info.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'maps_embed' => 'nullable|string',
        ]);

        ContactInfo::create($validated);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Informasi kontak berhasil ditambahkan.');
    }

    public function edit(ContactInfo $contactInfo)
    {
        return view('admin.contact-info.edit', compact('contactInfo'));
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $validated = $request->validate([
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'maps_embed' => 'nullable|string',
        ]);

        $contactInfo->update($validated);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Informasi kontak berhasil diperbarui.');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Informasi kontak berhasil dihapus.');
    }

    public function toggleActive(ContactInfo $contactInfo)
    {
        // Nonaktifkan semua kontak lain jika ini akan diaktifkan
        if (!$contactInfo->is_active) {
            ContactInfo::where('id', '!=', $contactInfo->id)->update(['is_active' => false]);
        }

        $contactInfo->is_active = !$contactInfo->is_active;
        $contactInfo->save();

        return back()->with('success', 'Status kontak berhasil diubah.');
    }
}
