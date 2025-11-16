<x-guest-layout>
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Formulir Pendaftaran</h2>
        <p class="text-gray-600">Bergabunglah dengan HIMPAUDI Bekasi Timur</p>
        <div class="mt-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm text-blue-800">
                    <p class="font-semibold mb-1">Perhatian:</p>
                    <ul class="space-y-1 text-xs">
                        <li>• Lengkapi semua data dengan benar dan akurat</li>
                        <li>• Akun akan diverifikasi oleh admin sebelum diaktifkan</li>
                        <li>• Field bertanda (*) wajib diisi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- SECTION 1: DATA AKUN -->
        <div class="space-y-4">
            <div class="flex items-center gap-3 pb-3 border-b-2 border-blue-600">
                <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                <h3 class="text-xl font-bold text-gray-800">Data Akun Login</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="username" value="Username *" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" value="Email *" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" value="Password *" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="Konfirmasi Password *" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- SECTION 2: DATA PRIBADI -->
        <div class="space-y-4">
            <div class="flex items-center gap-3 pb-3 border-b-2 border-blue-600">
                <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                <h3 class="text-xl font-bold text-gray-800">Data Pribadi</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <x-input-label for="nama_lengkap" value="Nama Lengkap (sesuai KTP) *" />
                    <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap')" required />
                    <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="niptk_nuptk" value="NIPTK / NUPTK" />
                    <x-text-input id="niptk_nuptk" class="block mt-1 w-full" type="text" name="niptk_nuptk" :value="old('niptk_nuptk')" />
                    <x-input-error :messages="$errors->get('niptk_nuptk')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="no_kta_lama" value="No. KTA Sebelumnya" />
                    <x-text-input id="no_kta_lama" class="block mt-1 w-full" type="text" name="no_kta_lama" :value="old('no_kta_lama')" />
                    <x-input-error :messages="$errors->get('no_kta_lama')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="no_ktp" value="No. KTP/SIM *" />
                    <x-text-input id="no_ktp" class="block mt-1 w-full" type="text" name="no_ktp" :value="old('no_ktp')" required maxlength="16" />
                    <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="tempat_lahir" value="Tempat Lahir *" />
                    <x-text-input id="tempat_lahir" class="block mt-1 w-full" type="text" name="tempat_lahir" :value="old('tempat_lahir')" required />
                    <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="tanggal_lahir" value="Tanggal Lahir *" />
                    <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required />
                    <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="jenis_kelamin" value="Jenis Kelamin *" />
                    <select id="jenis_kelamin" name="jenis_kelamin" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="pendidikan_terakhir" value="Pendidikan Terakhir *" />
                    <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Pilih</option>
                        <option value="SMA/SMK" {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="D1" {{ old('pendidikan_terakhir') == 'D1' ? 'selected' : '' }}>D1</option>
                        <option value="D2" {{ old('pendidikan_terakhir') == 'D2' ? 'selected' : '' }}>D2</option>
                        <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ old('pendidikan_terakhir') == 'D4' ? 'selected' : '' }}>D4</option>
                        <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3</option>
                    </select>
                    <x-input-error :messages="$errors->get('pendidikan_terakhir')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="jurusan" value="Jurusan" />
                    <x-text-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan" :value="old('jurusan')" />
                    <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="gaji" value="Gaji (Rp)" />
                    <x-text-input id="gaji" class="block mt-1 w-full" type="number" name="gaji" :value="old('gaji')" min="0" />
                    <x-input-error :messages="$errors->get('gaji')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="tmt_kerja" value="TMT Kerja *" />
                    <x-text-input id="tmt_kerja" class="block mt-1 w-full" type="date" name="tmt_kerja" :value="old('tmt_kerja')" required />
                    <x-input-error :messages="$errors->get('tmt_kerja')" class="mt-2" />
                    <p class="text-xs text-gray-500 mt-1">Tanggal Mulai Tugas</p>
                </div>

                <div>
                    <x-input-label for="no_hp" value="No. HP/WhatsApp *" />
                    <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')" required maxlength="15" />
                    <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="alamat_domisili" value="Alamat Domisili Lengkap *" />
                    <textarea id="alamat_domisili" name="alamat_domisili" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('alamat_domisili') }}</textarea>
                    <x-input-error :messages="$errors->get('alamat_domisili')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label value="Riwayat Pelatihan/Diklat" />
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" name="riwayat_diklat[]" value="Dasar" class="rounded border-gray-300 text-blue-600" {{ in_array('Dasar', old('riwayat_diklat', [])) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm">Dasar</span>
                        </label>
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" name="riwayat_diklat[]" value="Lanjutan" class="rounded border-gray-300 text-blue-600" {{ in_array('Lanjutan', old('riwayat_diklat', [])) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm">Lanjutan</span>
                        </label>
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" name="riwayat_diklat[]" value="Mahir" class="rounded border-gray-300 text-blue-600" {{ in_array('Mahir', old('riwayat_diklat', [])) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm">Mahir</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('riwayat_diklat')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="foto_profil" value="Foto Profil (Max: 2MB)" />
                    <input id="foto_profil" type="file" name="foto_profil" accept="image/jpeg,image/png,image/jpg" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <x-input-error :messages="$errors->get('foto_profil')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- SECTION 3: DATA LEMBAGA -->
        <div class="space-y-4">
            <div class="flex items-center gap-3 pb-3 border-b-2 border-blue-600">
                <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                <h3 class="text-xl font-bold text-gray-800">Data Lembaga</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <x-input-label for="nama_lembaga" value="Nama PAUD/TK/KB *" />
                    <x-text-input id="nama_lembaga" class="block mt-1 w-full" type="text" name="nama_lembaga" :value="old('nama_lembaga')" required />
                    <x-input-error :messages="$errors->get('nama_lembaga')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="npsn" value="NPSN *" />
                    <x-text-input id="npsn" class="block mt-1 w-full" type="text" name="npsn" :value="old('npsn')" required maxlength="8" />
                    <x-input-error :messages="$errors->get('npsn')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="kelurahan" value="Kelurahan *" />
                    <select id="kelurahan" name="kelurahan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Pilih Kelurahan</option>
                        <option value="Aren Jaya" {{ old('kelurahan') == 'Aren Jaya' ? 'selected' : '' }}>Aren Jaya</option>
                        <option value="Bekasi Jaya" {{ old('kelurahan') == 'Bekasi Jaya' ? 'selected' : '' }}>Bekasi Jaya</option>
                        <option value="Duren Jaya" {{ old('kelurahan') == 'Duren Jaya' ? 'selected' : '' }}>Duren Jaya</option>
                        <option value="Margahayu" {{ old('kelurahan') == 'Margahayu' ? 'selected' : '' }}>Margahayu</option>
                    </select>
                    <x-input-error :messages="$errors->get('kelurahan')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="alamat_lembaga" value="Alamat Lengkap Lembaga *" />
                    <textarea id="alamat_lembaga" name="alamat_lembaga" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('alamat_lembaga') }}</textarea>
                    <x-input-error :messages="$errors->get('alamat_lembaga')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="no_telp_lembaga" value="No. Telepon Lembaga" />
                    <x-text-input id="no_telp_lembaga" class="block mt-1 w-full" type="text" name="no_telp_lembaga" :value="old('no_telp_lembaga')" maxlength="15" />
                    <x-input-error :messages="$errors->get('no_telp_lembaga')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email_lembaga" value="Email Lembaga" />
                    <x-text-input id="email_lembaga" class="block mt-1 w-full" type="email" name="email_lembaga" :value="old('email_lembaga')" />
                    <x-input-error :messages="$errors->get('email_lembaga')" class="mt-2" />
                </div>
            </div>
        </div>


        <!-- Important Info -->
        <div class="bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 p-5 rounded-r-lg">
            <div class="flex gap-3">
                <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-bold text-amber-900 mb-2">Proses Setelah Pendaftaran:</p>
                    <ul class="text-sm text-amber-800 space-y-1.5">
                        <li class="flex items-start gap-2">
                            <span class="text-amber-600 font-bold">1.</span>
                            <span>Akun Anda akan berstatus <strong>Pending</strong> setelah pendaftaran</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-600 font-bold">2.</span>
                            <span>Admin akan melakukan <strong>verifikasi data</strong> yang Anda kirimkan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-600 font-bold">3.</span>
                            <span>Anda akan menerima <strong>notifikasi email</strong> jika akun disetujui</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-600 font-bold">4.</span>
                            <span>Setelah disetujui, Anda dapat <strong>login dan mengakses dashboard</strong></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col-reverse sm:flex-row gap-4 pt-6 border-t border-gray-200">
            <a href="{{ route('login') }}" 
               class="flex-1 inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Sudah Punya Akun
            </a>

            <button type="submit" 
                class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Daftar Sekarang
            </button>
        </div>
    </form>
</x-guest-layout>
