@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detail Lowongan Kerja</h1>

    <h2>{{ $lowongan->judul_lowongan }}</h2>
    <p><strong>Perusahaan:</strong> {{ $lowongan->nama_perusahaan }}</p>
    <p><strong>Alamat:</strong> {{ $lowongan->alamat_perusahaan }}</p>
    <p><strong>Kontak:</strong> {{ $lowongan->kontak_perusahaan }}</p>
    <p><strong>Tanggal Buka:</strong> {{ $lowongan->tanggal_buka }}</p>
    <p><strong>Tanggal Tutup:</strong> {{ $lowongan->tanggal_tutup }}</p>
    <p><strong>Deskripsi:</strong></p>
    <p>{{ $lowongan->deskripsi }}</p>

    <form action="{{ route('pelamar.apply', $lowongan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin melamar lowongan ini?');">
        @csrf
        <button type="submit">Lamar Lowongan Ini</button>
    </form>

    <br>
    <a href="{{ route('pelamar.list_lowongan') }}">Kembali ke Daftar Lowongan</a>
</div>
@endsection
