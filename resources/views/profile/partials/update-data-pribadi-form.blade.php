<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Data Pribadi
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi pribadi Anda. Simpan perubahan untuk mengirim pembaruan ke sistem.
        </p>
    </header>

    <form method="post" action="{{ route('profile.data-pribadi.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full" :value="old('nama_lengkap', $dataPribadi->nama_lengkap)" required />
                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
            </div>

            <div>
                <x-input-label for="niptk_nuptk" value="NIPTK / NUPTK" />
                <x-text-input id="niptk_nuptk" name="niptk_nuptk" type="text" class="mt-1 block w-full" :value="old('niptk_nuptk', $dataPribadi->niptk_nuptk)" />
                <x-input-error class="mt-2" :messages="$errors->get('niptk_nuptk')" />
            </div>

            <div>
                <x-input-label for="no_kta_lama" value="No. KTA Sebelumnya" />
                <x-text-input id="no_kta_lama" name="no_kta_lama" type="text" class="mt-1 block w-full" :value="old('no_kta_lama', $dataPribadi->no_kta_lama)" />
                <x-input-error class="mt-2" :messages="$errors->get('no_kta_lama')" />
            </div>

            <div>
                <x-input-label for="no_ktp" value="No. KTP/SIM" />
                <x-text-input id="no_ktp" name="no_ktp" type="text" class="mt-1 block w-full" :value="old('no_ktp', $dataPribadi->no_ktp)" required maxlength="16" />
                <x-input-error class="mt-2" :messages="$errors->get('no_ktp')" />
            </div>

            <div>
                <x-input-label for="tempat_lahir" value="Tempat Lahir" />
                <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full" :value="old('tempat_lahir', $dataPribadi->tempat_lahir)" required />
                <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
            </div>

            <div>
                <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir', optional($dataPribadi->tanggal_lahir)->format('Y-m-d'))" required />
                <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
            </div>

            <div>
                <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki" @selected(old('jenis_kelamin', $dataPribadi->jenis_kelamin)==='Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(old('jenis_kelamin', $dataPribadi->jenis_kelamin)==='Perempuan')>Perempuan</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
            </div>

            <div>
                <x-input-label for="pendidikan_terakhir" value="Pendidikan Terakhir" />
                <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    @php($pendidikanOpts = ['SMA/SMK','D1','D2','D3','D4','S1','S2','S3'])
                    <option value="">Pilih</option>
                    @foreach($pendidikanOpts as $opt)
                        <option value="{{ $opt }}" @selected(old('pendidikan_terakhir', $dataPribadi->pendidikan_terakhir)===$opt)>{{ $opt }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('pendidikan_terakhir')" />
            </div>

            <div>
                <x-input-label for="tmt_kerja" value="TMT Kerja" />
                <x-text-input id="tmt_kerja" name="tmt_kerja" type="date" class="mt-1 block w-full" :value="old('tmt_kerja', optional($dataPribadi->tmt_kerja)->format('Y-m-d'))" required />
                <x-input-error class="mt-2" :messages="$errors->get('tmt_kerja')" />
            </div>

            <div>
                <x-input-label for="no_hp" value="No. HP/WhatsApp" />
                <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $dataPribadi->no_hp)" required maxlength="15" />
                <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
            </div>

            <div class="md:col-span-2">
                <x-input-label for="alamat_domisili" value="Alamat Domisili Lengkap" />
                <textarea id="alamat_domisili" name="alamat_domisili" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('alamat_domisili', $dataPribadi->alamat_domisili) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('alamat_domisili')" />
            </div>

            <div class="md:col-span-2">
                <x-input-label value="Riwayat Pelatihan/Diklat" />
                @php($diklat = old('riwayat_diklat', $dataPribadi->riwayat_diklat ?? []))
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="riwayat_diklat[]" value="Dasar" class="rounded border-gray-300 text-blue-600" {{ in_array('Dasar', $diklat) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm">Dasar</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="riwayat_diklat[]" value="Lanjutan" class="rounded border-gray-300 text-blue-600" {{ in_array('Lanjutan', $diklat) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm">Lanjutan</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="riwayat_diklat[]" value="Mahir" class="rounded border-gray-300 text-blue-600" {{ in_array('Mahir', $diklat) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm">Mahir</span>
                    </label>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('riwayat_diklat')" />
            </div>

            <div class="md:col-span-2">
                <x-input-label for="foto_profil" value="Foto Profil (Max: 2MB)" />
                @if($dataPribadi->foto_profil)
                    <div class="flex items-center space-x-3 mt-1">
                        <img src="{{ asset('storage/'.$dataPribadi->foto_profil) }}" alt="Foto Profil" class="h-12 w-12 rounded-full object-cover">
                        <span class="text-xs text-gray-500">Ganti foto untuk memperbarui.</span>
                    </div>
                @endif
                <input id="foto_profil" name="foto_profil" type="file" accept="image/jpeg,image/png,image/jpg,image/webp" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                <x-input-error class="mt-2" :messages="$errors->get('foto_profil')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'data-pribadi-updated')
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
