@extends('adminlte::page')

@section('title', 'Daftar Perusahaan Mitra')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">
            <i class="fas fa-building mr-2"></i>Daftar Perusahaan Mitra
        </h1>
        <a href="{{ route('perusahaan.create') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="fas fa-plus mr-2"></i>Tambah Perusahaan Baru
        </a>
    </div>
@stop

@section('content')
    <!-- Main Table Card -->
    <div class="card shadow border-0">
        <div class="card-header bg-gradient-primary text-white py-3">
            <h5 class="card-title mb-0 font-weight-bold">
                <i class="fas fa-list mr-2"></i>Data Perusahaan Mitra
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light-blue">
                        <tr>
                            <th class="text-center fw-semibold text-white py-3" style="width: 60px;">No</th>
                            <th class="fw-semibold text-white py-3" style="width: 120px;">Kode</th>
                            <th class="fw-semibold text-white py-3" style="width: 250px;">Nama Perusahaan</th>
                            <th class="fw-semibold text-white py-3" style="width: 150px;">Alamat</th>
                            <th class="fw-semibold text-white py-3" style="width: 150px;">Kontak</th>
                            <th class="fw-semibold text-white py-3" style="width: 80px;">Logo</th>
                            <th class="text-center fw-semibold text-white py-3" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perusahaan as $item)
                            <tr class="border-bottom">
                                <td class="text-center align-middle">
                                    <span class="badge bg-primary rounded-circle p-2">
                                        {{ $loop->iteration + ($perusahaan->currentPage() - 1) * $perusahaan->perPage() }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary rounded-pill px-3 py-2 font-weight-bold">
                                        {{ $item->kode_perusahaan }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <div class="fw-bold text-dark">{{ $item->nama_perusahaan }}</div>
                                </td>
                                <td class="align-middle">
                                    <small class="text-muted">{{ Str::limit($item->alamat, 40) }}</small>
                                </td>
                                <td class="align-middle">
                                    <div>
                                        @if($item->telepon)
                                            <div class="text-primary small">
                                                <i class="fas fa-phone-alt mr-1"></i>{{ $item->telepon }}
                                            </div>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                        @if($item->email)
                                            <div class="text-info small">
                                                <i class="fas fa-envelope mr-1"></i>{{ Str::limit($item->email, 20) }}
                                            </div>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="logo-container">
                                        @if ($item->logo_path)
                                            <img src="{{ asset($item->logo_path) }}" 
                                                 alt="{{ $item->nama_perusahaan }}" 
                                                 class="rounded shadow-sm" 
                                                 style="width: 45px; height: 45px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 45px; height: 45px;">
                                                <i class="fas fa-building text-muted fa-sm"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('perusahaan.show', $item->id) }}" 
                                           class="btn btn-info" 
                                           data-toggle="tooltip" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('perusahaan.edit', $item->id) }}" 
                                           class="btn btn-warning" 
                                           data-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('perusahaan.destroy', $item->id) }}" method="POST" 
                                              style="display:inline-block;" 
                                              onsubmit="return confirm('Yakin ingin menghapus perusahaan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger" 
                                                    data-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-building fa-3x mb-3 opacity-50"></i>
                                        <h5>Belum ada data perusahaan</h5>
                                        <p class="mb-3">Silakan tambah perusahaan baru untuk memulai</p>
                                        <a href="{{ route('perusahaan.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus mr-2"></i>Tambah Perusahaan Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan <strong>{{ $perusahaan->firstItem() ?? 0 }} - {{ $perusahaan->lastItem() ?? 0 }}</strong> 
                    dari <strong>{{ $perusahaan->total() }}</strong> perusahaan
                </div>
                <div>
                    {{ $perusahaan->links('vendor.pagination.adminlte') }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .bg-light-blue {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%) !important;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.08) !important;
            transition: all 0.2s ease;
        }
        
        .card {
            border: none;
            border-radius: 10px;
        }
        
        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }
        
        .btn {
            border-radius: 6px;
            font-weight: 500;
        }
        
        .btn-group .btn {
            border-radius: 0;
            margin: 0 1px;
        }
        
        .btn-group .btn:first-child {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }
        
        .btn-group .btn:last-child {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }
        
        .badge.rounded-circle {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.8rem;
        }
        
        .table td, .table th {
            vertical-align: middle;
        }
        
        .logo-container img {
            transition: transform 0.2s ease;
        }
        
        .logo-container img:hover {
            transform: scale(1.1);
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
