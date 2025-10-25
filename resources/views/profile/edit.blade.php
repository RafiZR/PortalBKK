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

    {{-- Tambahkan enctype="multipart/form-data" untuk upload file --}}
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        {{-- NIK --}}
        <div class="mb-3">
            <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
            <input type="text" name="nik" id="nik" class="form-control" value="{{ old('nik', $user->nik) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        {{-- No HP/WA --}}
        <div class="mb-3">
            <label for="no_hp_wa" class="form-label">No HP/WA</label>
            <input type="text" name="no_hp_wa" id="no_hp_wa" class="form-control" value="{{ old('no_hp_wa', $user->no_hp_wa) }}" required placeholder="Contoh: 081234567890">
        </div>

        {{-- Tempat Lahir --}}
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" required>
        </div>

        {{-- Tanggal Lahir --}}
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            {{-- Pastikan format tanggal sesuai untuk input type="date" --}}
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : '') }}" required>
            <div id="umur_display_profile" class="text-sm text-muted mt-1"></div>
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        {{-- Alamat Lengkap --}}
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        {{-- Jurusan --}}
        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan', $user->jurusan) }}" required>
        </div>

        {{-- Asal Sekolah --}}
        <div class="mb-3">
            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
            <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $user->asal_sekolah) }}" required>
        </div>

        {{-- Tahun Lulus --}}
        <div class="mb-3">
            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
            <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control" value="{{ old('tahun_lulus', $user->tahun_lulus) }}" required placeholder="Contoh: 2022 atau 2021/2022">
        </div>

        {{-- Domisili --}}
        <div class="mb-3">
            <label for="domisili" class="form-label">Domisili</label>
            <select name="domisili" id="domisili" class="form-control" required>
                <option value="">Pilih Domisili</option>
                {{-- Disesuaikan dengan enum di migrasi --}}
                <option value="Kuningan" {{ old('domisili', $user->domisili) == 'Kuningan' ? 'selected' : '' }}>Kuningan</option>
                <option value="Cirebon" {{ old('domisili', $user->domisili) == 'Cirebon' ? 'selected' : '' }}>Cirebon</option>
            </select>
        </div>

        {{-- NPWP --}}
        <div class="mb-3">
            <label for="npwp" class="form-label">Nomor Pokok Wajib Pajak (NPWP)</label>
            <input type="text" name="npwp" id="npwp" class="form-control" value="{{ old('npwp', $user->npwp) }}" required>
        </div>

        {{-- BPJS Kesehatan --}}
        <div class="mb-3">
            <label for="bpjs_kesehatan" class="form-label">Nomor BPJS Kesehatan</label>
            <input type="text" name="bpjs_kesehatan" id="bpjs_kesehatan" class="form-control" value="{{ old('bpjs_kesehatan', $user->bpjs_kesehatan) }}" required>
        </div>

        {{-- Berat Badan (Nullable) --}}
        <div class="mb-3">
            <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
            <input type="text" name="berat_badan" id="berat_badan" class="form-control" value="{{ old('berat_badan', $user->berat_badan) }}">
        </div>

        {{-- Tinggi Badan (Nullable) --}}
        <div class="mb-3">
            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
            <input type="text" name="tinggi_badan" id="tinggi_badan" class="form-control" value="{{ old('tinggi_badan', $user->tinggi_badan) }}">
        </div>

        {{-- Foto Profile (Nullable) --}}
        <div class="mb-3">
            <label for="foto_profile" class="form-label">Foto Profil</label>
            <input type="file" name="foto_profile" id="foto_profile" class="form-control">
            @if($user->foto_profile)
                <small class="form-text text-muted">Foto saat ini: <a href="{{ asset('storage/' . $user->foto_profile) }}" target="_blank">{{ $user->foto_profile }}</a></small>
                <img src="{{ asset('storage/' . $user->foto_profile) }}" alt="Foto Profil" class="img-thumbnail mt-2" style="max-width: 150px;">
            @else
                <small class="form-text text-muted">Belum ada foto profil.</small>
            @endif
            <small class="form-text text-muted">Opsional. Biarkan kosong jika tidak ingin mengubah. Format: JPG, PNG. Max: 2MB</small>
        </div>

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
            const birthDateValue = tanggalLahirInputProfile.value;
            if (!birthDateValue) {
                umurDisplayProfile.textContent = '';
                return;
            }

            const birthDate = new Date(birthDateValue);
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
            umurDisplayProfile.textContent = `Umur Anda: ${age} tahun`;
        }

        tanggalLahirInputProfile.addEventListener('change', calculateAgeProfile);

        // Hitung umur saat halaman pertama kali dimuat jika ada nilai
        if (tanggalLahirInputProfile.value) {
            calculateAgeProfile();
        }
    });
</script>
@stop
