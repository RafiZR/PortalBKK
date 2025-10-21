@extends('adminlte::page')

@section('title', 'Edit Profil')

@section('content_header')
    <h1>Edit Profil</h1>
@stop

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        {{-- Kolom-kolom baru --}}
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" required>
            <div id="umur_display_profile" class="text-sm text-muted mt-1"></div>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan', $user->jurusan) }}" required>
        </div>

        <div class="mb-3">
            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
            <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $user->asal_sekolah) }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
            <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control" value="{{ old('tahun_lulus', $user->tahun_lulus) }}" required placeholder="Contoh: 2022 atau 2021/2022">
        </div>

        <div class="mb-3">
            <label for="asal_bkk" class="form-label">Asal BKK</label>
            <select name="asal_bkk" id="asal_bkk" class="form-control" required>
                <option value="">Pilih Asal BKK</option>
                @php
                    $bkkOptions = ['smkn 1 cilimus', 'smkn 2 kuningan', 'smkn 5 kuningan', 'smk pertiwi cilimus', 'lainnya'];
                @endphp
                @foreach($bkkOptions as $option)
                    <option value="{{ $option }}" {{ old('asal_bkk', $user->asal_bkk) == $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="domisili" class="form-label">Domisili</label>
            <select name="domisili" id="domisili" class="form-control" required>
                <option value="">Pilih Domisili</option>
                @php
                    $domisiliOptions = ['kuningan', 'cirebon', 'majalengka', 'cilacap', 'lainnya'];
                @endphp
                @foreach($domisiliOptions as $option)
                    <option value="{{ $option }}" {{ old('domisili', $user->domisili) == $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="no_hp_wa" class="form-label">No HP/WA</label>
            <input type="text" name="no_hp_wa" id="no_hp_wa" class="form-control" value="{{ old('no_hp_wa', $user->no_hp_wa) }}" required placeholder="Contoh: 081234567890">
        </div>
        {{-- Akhir Kolom-kolom baru --}}

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru (kosongkan jika tidak ingin ganti)</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

{{-- Script untuk perhitungan umur otomatis di halaman profil --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalLahirInputProfile = document.getElementById('tanggal_lahir');
        const umurDisplayProfile = document.getElementById('umur_display_profile');

        function calculateAgeProfile() {
            const birthDate = new Date(tanggalLahirInputProfile.value);
            if (isNaN(birthDate)) {
                umurDisplayProfile.textContent = '';
                return;
            }
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            umurDisplayProfile.textContent = `Umur: ${age} tahun`;
        }

        tanggalLahirInputProfile.addEventListener('change', calculateAgeProfile);

        // Hitung umur saat halaman pertama kali dimuat jika ada nilai
        if (tanggalLahirInputProfile.value) {
            calculateAgeProfile();
        }
    });
</script>
@stop
