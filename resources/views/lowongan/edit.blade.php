@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Edit Lowongan Kerja</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Judul Lowongan:</label><br>
        <input type="text" name="judul_lowongan" value="{{ old('judul_lowongan', $lowongan->judul_lowongan) }}" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="5" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea><br><br>

        <label>Nama Perusahaan:</label><br>
        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $lowongan->nama_perusahaan) }}" required><br><br>

        <label>Alamat Perusahaan:</label><br>
        <input type="text" name="alamat_perusahaan" value="{{ old('alamat_perusahaan', $lowongan->alamat_perusahaan) }}" required><br><br>

        <label>Kontak Perusahaan:</label><br>
        <input type="text" name="kontak_perusahaan" value="{{ old('kontak_perusahaan', $lowongan->kontak_perusahaan) }}" required><br><br>

        <label>Tanggal Buka:</label><br>
        <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka', $lowongan->tanggal_buka) }}" required><br><br>

        <label>Tanggal Tutup:</label><br>
        <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup', $lowongan->tanggal_tutup) }}" required><br><br>

        <button type="submit">Update</button>
        <a href="{{ route('lowongan.index') }}">Batal</a>
    </form>
</div>
@endsection
