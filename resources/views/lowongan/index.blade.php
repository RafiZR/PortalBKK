@extends('adminlte::page')

@section('title', 'Daftar Lowongan Kerja')

@section('content_header')
    <h1>Daftar Lowongan Kerja</h1>
@stop

@section('content')
    <a href="{{ route('lowongan.create') }}" class="btn btn-primary mb-3">+ Tambah Lowongan Baru</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Judul Lowongan</th>
                <th>Perusahaan</th>
                <th>Alamat</th>
                <th>Kontak</th>
                <th>Tanggal Buka</th>
                <th>Tanggal Tutup</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lowongans as $lowongan)
            <tr>
                <td>{{ $lowongan->judul_lowongan }}</td>
                <td>{{ $lowongan->nama_perusahaan }}</td>
                <td>{{ $lowongan->alamat_perusahaan }}</td>
                <td>{{ $lowongan->kontak_perusahaan }}</td>
                <td>{{ $lowongan->tanggal_buka }}</td>
                <td>{{ $lowongan->tanggal_tutup }}</td>
                <td>
                    <a href="{{ route('lowongan.edit', $lowongan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                    <a href="{{ route('lowongan.pelamar', $lowongan->id) }}" class="btn btn-sm btn-info">Daftar Pelamar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $lowongans->links() }}
@stop
