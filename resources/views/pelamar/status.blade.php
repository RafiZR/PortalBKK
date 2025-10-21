@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Status Lamaran Saya</h1>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top: 10px;">
        <thead>
            <tr>
                <th>Judul Lowongan</th>
                <th>Perusahaan</th>
                <th>Tanggal Lamar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lamaran as $item)
            <tr>
                <td>{{ $item->lowonganKerja->judul_lowongan }}</td>
                <td>{{ $item->lowonganKerja->nama_perusahaan }}</td>
                <td>{{ $item->tanggal_lamar }}</td>
                <td>
                    @if($item->status_lamaran == 'pending')
                        <span style="color:orange;">Pending</span>
                    @elseif($item->status_lamaran == 'diterima')
                        <span style="color:green;">Diterima</span>
                    @else
                        <span style="color:red;">Ditolak</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;">Belum ada lamaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        {{ $lamaran->links() }}
    </div>
</div>
@endsection
