<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Kolom-kolom baru --}}
        <div class="mt-4">
            <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
            <x-text-input id="tempat_lahir" class="block mt-1 w-full" type="text" name="tempat_lahir" :value="old('tempat_lahir')" required autocomplete="tempat_lahir" />
            <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required autocomplete="tanggal_lahir" />
            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
            <div id="umur_display" class="text-sm text-gray-600 mt-1"></div>
        </div>

        <div class="mt-4">
            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
            <select id="jenis_kelamin" name="jenis_kelamin" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
            <textarea id="alamat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="alamat" required>{{ old('alamat') }}</textarea>
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="jurusan" :value="__('Jurusan')" />
            <x-text-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan" :value="old('jurusan')" required autocomplete="jurusan" />
            <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="asal_sekolah" :value="__('Asal Sekolah')" />
            <x-text-input id="asal_sekolah" class="block mt-1 w-full" type="text" name="asal_sekolah" :value="old('asal_sekolah')" required autocomplete="asal_sekolah" />
            <x-input-error :messages="$errors->get('asal_sekolah')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="tahun_lulus" :value="__('Tahun Lulus')" />
            <x-text-input id="tahun_lulus" class="block mt-1 w-full" type="text" name="tahun_lulus" :value="old('tahun_lulus')" required autocomplete="tahun_lulus" placeholder="Contoh: 2022 atau 2021/2022" />
            <x-input-error :messages="$errors->get('tahun_lulus')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="asal_bkk" :value="__('Asal BKK')" />
            <select id="asal_bkk" name="asal_bkk" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Pilih Asal BKK</option>
                @php
                    $bkkOptions = ['smkn 1 cilimus', 'smkn 2 kuningan', 'smkn 5 kuningan', 'smk pertiwi cilimus', 'lainnya'];
                @endphp
                @foreach($bkkOptions as $option)
                    <option value="{{ $option }}" {{ old('asal_bkk') == $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('asal_bkk')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="domisili" :value="__('Domisili')" />
            <select id="domisili" name="domisili" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Pilih Domisili</option>
                @php
                    $domisiliOptions = ['kuningan', 'cirebon', 'majalengka', 'cilacap', 'lainnya'];
                @endphp
                @foreach($domisiliOptions as $option)
                    <option value="{{ $option }}" {{ old('domisili') == $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('domisili')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="no_hp_wa" :value="__('No HP/WA')" />
            <x-text-input id="no_hp_wa" class="block mt-1 w-full" type="text" name="no_hp_wa" :value="old('no_hp_wa')" required autocomplete="no_hp_wa" placeholder="Contoh: 081234567890" />
            <x-input-error :messages="$errors->get('no_hp_wa')" class="mt-2" />
        </div>
        {{-- Akhir Kolom-kolom baru --}}

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    {{-- Script untuk perhitungan umur otomatis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalLahirInput = document.getElementById('tanggal_lahir');
            const umurDisplay = document.getElementById('umur_display');

            function calculateAge() {
                const birthDate = new Date(tanggalLahirInput.value);
                if (isNaN(birthDate)) {
                    umurDisplay.textContent = '';
                    return;
                }
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                umurDisplay.textContent = `Umur: ${age} tahun`;
            }

            tanggalLahirInput.addEventListener('change', calculateAge);

            // Hitung umur saat halaman pertama kali dimuat jika ada nilai lama
            if (tanggalLahirInput.value) {
                calculateAge();
            }
        });
    </script>
</x-guest-layout>
