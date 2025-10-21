@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Tambah Lowongan Kerja Baru</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lowongan.store') }}" method="POST">
        @csrf
        <label>Judul Lowongan:</label><br>
        <input type="text" name="judul_lowongan" value="{{ old('judul_lowongan') }}" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea><br><br>

        <label>Nama Perusahaan:</label><br>
        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" required><br><br>

        <label>Alamat Perusahaan:</label><br>
        <input type="text" name="alamat_perusahaan" value="{{ old('alamat_perusahaan') }}" required><br><br>

        <label>Kontak Perusahaan:</label><br>
        <input type="text" name="kontak_perusahaan" value="{{ old('kontak_perusahaan') }}" required><br><br>

        <label>Tanggal Buka:</label><br>
        <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka') }}" required><br><br>

        <label>Tanggal Tutup:</label><br>
        <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup') }}" required><br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('lowongan.index') }}">Batal</a>
    </form>
</div>
@endsection
