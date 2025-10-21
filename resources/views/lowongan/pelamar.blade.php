@extends('adminlte::page')

@section('title', 'Daftar Pelamar')

@section('content_header')
    <h1>Daftar Pelamar untuk: {{ $lowongan->judul_lowongan }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('lowongan.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Lowongan
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pelamar</h3>
                </div>
                <div class="card-body p-0"> {{-- p-0 untuk menghilangkan padding agar tabel full width --}}
                    <div class="table-responsive"> {{-- Membuat tabel responsif --}}
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Pelamar</th>
                                    <th>Email</th>
                                    <th>TTL</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Asal Sekolah</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Lulus</th> {{-- Tag <th> sudah benar --}}
                                    <th>Asal BKK</th>
                                    <th>Domisili</th>
                                    <th>No HP/WA</th>
                                    <th>Tanggal Lamar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowongan->pelamar as $pelamar)
                                <tr>
                                    <td>{{ $pelamar->user->name }}</td>
                                    <td>{{ $pelamar->user->email }}</td>
                                    <td>{{ $pelamar->user->tempat_lahir }}, {{ \Carbon\Carbon::parse($pelamar->user->tanggal_lahir)->format('d M Y') }}</td>
                                    <td>{{ $pelamar->user->jenis_kelamin }}</td>
                                    <td>{{ $pelamar->user->alamat }}</td>
                                    <td>{{ $pelamar->user->asal_sekolah }}</td>
                                    <td>{{ $pelamar->user->jurusan }}</td>
                                    <td>{{ $pelamar->user->tahun_lulus }}</td>
                                    <td>{{ $pelamar->user->asal_bkk }}</td>
                                    <td>{{ $pelamar->user->domisili }}</td>
                                    <td>{{ $pelamar->user->no_hp_wa }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pelamar->tanggal_lamar)->format('d M Y H:i') }}</td>
                                    <td>
                                        @php
                                            $statusClass = '';
                                            switch($pelamar->status_lamaran) {
                                                case 'pending': $statusClass = 'badge badge-warning'; break;
                                                case 'diterima': $statusClass = 'badge badge-success'; break;
                                                case 'ditolak': $statusClass = 'badge badge-danger'; break;
                                            }
                                        @endphp
                                        <span class="{{ $statusClass }}">{{ ucfirst($pelamar->status_lamaran) }}</span>
                                    </td>
                                    <td>
                                        @if($pelamar->status_lamaran == 'pending')
                                            <form action="{{ route('pelamar.update_status', $pelamar->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="status" value="diterima" class="btn btn-success btn-sm">
                                                    <i class="fas fa-check"></i> Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('pelamar.update_status', $pelamar->id) }}" method="POST" style="display:inline-block; margin-left: 5px;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="status" value="ditolak" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            </form>
                                        @else
                                            <em class="text-muted">Status sudah {{ ucfirst($pelamar->status_lamaran) }}</em>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="14" class="text-center text-muted">Belum ada pelamar untuk lowongan ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
