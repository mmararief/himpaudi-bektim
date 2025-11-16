<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Data Lembaga
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi lembaga tempat Anda bertugas.
        </p>
    </header>

    <form method="post" action="{{ route('profile.data-lembaga.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <x-input-label for="nama_lembaga" value="Nama PAUD/TK/KB" />
                <x-text-input id="nama_lembaga" name="nama_lembaga" type="text" class="mt-1 block w-full" :value="old('nama_lembaga', $dataLembaga->nama_lembaga)" required />
                <x-input-error class="mt-2" :messages="$errors->get('nama_lembaga')" />
            </div>

            <div class="md:col-span-2">
                <x-input-label for="npsn" value="NPSN (Nomor Pokok Sekolah Nasional)" />
                <x-text-input id="npsn" name="npsn" type="text" class="mt-1 block w-full" :value="old('npsn', $dataLembaga->npsn)" required maxlength="8" />
                <x-input-error class="mt-2" :messages="$errors->get('npsn')" />
                <p class="text-xs text-gray-500 mt-1">NPSN dapat sama untuk anggota dari lembaga yang sama</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'data-lembaga-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>
