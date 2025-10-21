@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Lowongan Kerja Tersedia</h1>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top: 10px;">
        <thead>
            <tr>
                <th>Judul Lowongan</th>
                <th>Perusahaan</th>
                <th>Tanggal Tutup</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lowongans as $lowongan)
            <tr>
                <td>{{ $lowongan->judul_lowongan }}</td>
                <td>{{ $lowongan->nama_perusahaan }}</td>
                <td>{{ $lowongan->tanggal_tutup }}</td>
                <td>
                    <a href="{{ route('pelamar.show_lowongan', $lowongan->id) }}">Detail & Lamar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;">Tidak ada lowongan kerja tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        {{ $lowongans->links() }}
    </div>
</div>
@endsection
