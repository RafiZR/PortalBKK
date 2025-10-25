@extends('adminlte::page')

@section('title', 'Detail Perusahaan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">
            <i class="fas fa-eye mr-2"></i>Detail Perusahaan
        </h1>
        <div>
            <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary btn-lg mr-2">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-warning btn-lg">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <!-- Main Info Card -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="card-title mb-0 font-weight-bold">
                        <i class="fas fa-building mr-2"></i>Informasi Perusahaan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kode Perusahaan -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-primary mb-1">
                                <i class="fas fa-code mr-1"></i>Kode Perusahaan
                            </label>
                            <div class="p-3 bg-light rounded border">
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary rounded-pill px-3 py-2 font-weight-bold">
                                    {{ $perusahaan->kode_perusahaan }}
                                </span>
                            </div>
                        </div>

                        <!-- Nama Perusahaan -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-primary mb-1">
                                <i class="fas fa-building mr-1"></i>Nama Perusahaan
                            </label>
                            <div class="p-3 bg-light rounded border">
                                <h6 class="mb-0 text-dark">{{ $perusahaan->nama_perusahaan }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label class="font-weight-bold text-primary mb-1">
                            <i class="fas fa-map-marker-alt mr-1"></i>Alamat
                        </label>
                        <div class="p-3 bg-light rounded border">
                            <p class="mb-0 text-dark">{{ $perusahaan->alamat }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Telepon -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-primary mb-1">
                                <i class="fas fa-phone mr-1"></i>Telepon
                            </label>
                            <div class="p-3 bg-light rounded border">
                                <p class="mb-0 text-dark">
                                    {{ $perusahaan->telepon ?: '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-primary mb-1">
                                <i class="fas fa-envelope mr-1"></i>Email
                            </label>
                            <div class="p-3 bg-light rounded border">
                                <p class="mb-0 text-dark">
                                    {{ $perusahaan->email ?: '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Website -->
                    <div class="mb-3">
                        <label class="font-weight-bold text-primary mb-1">
                            <i class="fas fa-globe mr-1"></i>Website
                        </label>
                        <div class="p-3 bg-light rounded border">
                            @if ($perusahaan->website)
                                <a href="{{ $perusahaan->website }}" target="_blank" class="text-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i>{{ $perusahaan->website }}
                                </a>
                            @else
                                <p class="mb-0 text-muted">-</p>
                            @endif
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="font-weight-bold text-primary mb-1">
                            <i class="fas fa-file-alt mr-1"></i>Deskripsi Perusahaan
                        </label>
                        <div class="p-3 bg-light rounded border">
                            <p class="mb-0 text-dark">
                                {{ $perusahaan->deskripsi ?: 'Tidak ada deskripsi' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Logo Card -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="card-title mb-0 font-weight-bold">
                        <i class="fas fa-image mr-2"></i>Logo Perusahaan
                    </h5>
                </div>
                <div class="card-body text-center">
                    @if ($perusahaan->logo_path)
                        <div class="mb-3">
                            <img src="{{ asset($perusahaan->logo_path) }}" 
                                 alt="Logo {{ $perusahaan->nama_perusahaan }}" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-height: 200px;">
                        </div>
                        <small class="text-muted">Logo saat ini</small>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-building fa-4x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Tidak ada logo</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Card -->
            <div class="card shadow border-0">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0 font-weight-bold text-primary">
                        <i class="fas fa-cogs mr-2"></i>Aksi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" 
                           class="btn btn-warning btn-lg">
                            <i class="fas fa-edit mr-2"></i>Edit Data
                        </a>
                        <form action="{{ route('perusahaan.destroy', $perusahaan->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus perusahaan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg w-100">
                                <i class="fas fa-trash mr-2"></i>Hapus Perusahaan
                            </button>
                        </form>
                        <a href="{{ route('perusahaan.index') }}" 
                           class="btn btn-secondary btn-lg">
                            <i class="fas fa-list mr-2"></i>Daftar Semua
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%) !important;
        }
        
        .card {
            border: none;
            border-radius: 10px;
        }
        
        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }
        
        .bg-light {
            background-color: #f8f9fa !important;
        }
    </style>
@stop
