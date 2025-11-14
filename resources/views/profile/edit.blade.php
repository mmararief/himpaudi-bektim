<x-member-layout>
    <x-slot name="title">Edit Profil</x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Profil</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi pribadi, lembaga, dan akun Anda</p>
            </div>
            <a href="{{ route('profile.show') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-600 hover:bg-gray-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Lihat Profil
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="p-6 sm:p-8 bg-white shadow-lg sm:rounded-2xl">
            <div class="max-w-3xl">
                @include('profile.partials.update-data-pribadi-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-lg sm:rounded-2xl">
            <div class="max-w-3xl">
                @include('profile.partials.update-data-lembaga-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-lg sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-lg sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-lg sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-member-layout>
