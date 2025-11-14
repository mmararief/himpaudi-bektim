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

            <div>
                <x-input-label for="npsn" value="NPSN" />
                <x-text-input id="npsn" name="npsn" type="text" class="mt-1 block w-full" :value="old('npsn', $dataLembaga->npsn)" required maxlength="8" />
                <x-input-error class="mt-2" :messages="$errors->get('npsn')" />
            </div>

            <div>
                <x-input-label for="kelurahan" value="Kelurahan" />
                @php($kelOptions = \App\Models\DataLembaga::getKelurahanOptions())
                <select id="kelurahan" name="kelurahan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">Pilih Kelurahan</option>
                    @foreach($kelOptions as $opt)
                        <option value="{{ $opt }}" @selected(old('kelurahan', $dataLembaga->kelurahan)===$opt)>{{ $opt }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('kelurahan')" />
            </div>

            <div class="md:col-span-2">
                <x-input-label for="alamat_lembaga" value="Alamat Lengkap Lembaga" />
                <textarea id="alamat_lembaga" name="alamat_lembaga" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('alamat_lembaga', $dataLembaga->alamat_lembaga) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('alamat_lembaga')" />
            </div>

            <div>
                <x-input-label for="no_telp_lembaga" value="No. Telepon Lembaga" />
                <x-text-input id="no_telp_lembaga" name="no_telp_lembaga" type="text" class="mt-1 block w-full" :value="old('no_telp_lembaga', $dataLembaga->no_telp_lembaga)" maxlength="15" />
                <x-input-error class="mt-2" :messages="$errors->get('no_telp_lembaga')" />
            </div>

            <div>
                <x-input-label for="email_lembaga" value="Email Lembaga" />
                <x-text-input id="email_lembaga" name="email_lembaga" type="email" class="mt-1 block w-full" :value="old('email_lembaga', $dataLembaga->email_lembaga)" />
                <x-input-error class="mt-2" :messages="$errors->get('email_lembaga')" />
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
