@extends('adminlte::page')

@section('title', 'Edit Perusahaan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">
            <i class="fas fa-edit mr-2"></i>Edit Perusahaan
        </h1>
        <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-info btn-lg">
            <i class="fas fa-eye mr-2"></i>Lihat Detail
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow border-0">
        <div class="card-header bg-gradient-primary text-white py-3">
            <h5 class="card-title mb-0 font-weight-bold">
                <i class="fas fa-building mr-2"></i>Edit Data Perusahaan
                <span class="badge bg-light text-primary ml-2">{{ $perusahaan->kode_perusahaan }}</span>
            </h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Terjadi Kesalahan!
                    </h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kode Perusahaan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_perusahaan" class="font-weight-bold text-primary">
                                <i class="fas fa-code mr-1"></i>Kode Perusahaan
                            </label>
                            <input type="text" 
                                   class="form-control rounded-lg border-primary bg-light" 
                                   id="kode_perusahaan" 
                                   name="kode_perusahaan"
                                   value="{{ old('kode_perusahaan', $perusahaan->kode_perusahaan) }}" 
                                   readonly>
                            <small class="form-text text-muted">
                                Kode perusahaan tidak dapat diubah
                            </small>
                        </div>
                    </div>

                    <!-- Nama Perusahaan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_perusahaan" class="font-weight-bold text-primary">
                                <i class="fas fa-building mr-1"></i>Nama Perusahaan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control rounded-lg border-primary @error('nama_perusahaan') is-invalid @enderror" 
                                   id="nama_perusahaan" 
                                   name="nama_perusahaan" 
                                   value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}" 
                                   placeholder="Masukkan nama perusahaan" 
                                   required>
                            @error('nama_perusahaan')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="form-group">
                    <label for="alamat" class="font-weight-bold text-primary">
                        <i class="fas fa-map-marker-alt mr-1"></i>Alamat <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control rounded-lg border-primary @error('alamat') is-invalid @enderror" 
                              id="alamat" 
                              name="alamat" 
                              rows="3" 
                              placeholder="Masukkan alamat lengkap perusahaan" 
                              required>{{ old('alamat', $perusahaan->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <!-- Telepon -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telepon" class="font-weight-bold text-primary">
                                <i class="fas fa-phone mr-1"></i>Telepon
                            </label>
                            <input type="text" 
                                   class="form-control rounded-lg border-primary @error('telepon') is-invalid @enderror" 
                                   id="telepon" 
                                   name="telepon" 
                                   value="{{ old('telepon', $perusahaan->telepon) }}" 
                                   placeholder="Masukkan nomor telepon">
                            @error('telepon')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="font-weight-bold text-primary">
                                <i class="fas fa-envelope mr-1"></i>Email
                            </label>
                            <input type="email" 
                                   class="form-control rounded-lg border-primary @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $perusahaan->email) }}" 
                                   placeholder="Masukkan alamat email">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Website -->
                <div class="form-group">
                    <label for="website" class="font-weight-bold text-primary">
                        <i class="fas fa-globe mr-1"></i>Website
                    </label>
                    <input type="url" 
                           class="form-control rounded-lg border-primary @error('website') is-invalid @enderror" 
                           id="website" 
                           name="website" 
                           value="{{ old('website', $perusahaan->website) }}" 
                           placeholder="https://example.com">
                    @error('website')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi" class="font-weight-bold text-primary">
                        <i class="fas fa-file-alt mr-1"></i>Deskripsi Perusahaan
                    </label>
                    <textarea class="form-control rounded-lg border-primary @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" 
                              name="deskripsi" 
                              rows="4" 
                              placeholder="Masukkan deskripsi perusahaan">{{ old('deskripsi', $perusahaan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="form-group">
                    <label class="font-weight-bold text-primary">
                        <i class="fas fa-image mr-1"></i>Logo Perusahaan
                    </label>
                    
                    <!-- Current Logo -->
                    @if ($perusahaan->logo_path)
                        <div class="mb-3 p-3 border rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="{{ asset($perusahaan->logo_path) }}" 
                                         alt="Logo {{ $perusahaan->nama_perusahaan }}" 
                                         class="rounded shadow-sm" 
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                                <div class="col">
                                    <p class="mb-1 font-weight-bold text-primary">Logo Saat Ini</p>
                                    <div class="form-check">
                                        <input type="checkbox" 
                                               class="form-check-input" 
                                               id="remove_logo" 
                                               name="remove_logo" 
                                               value="1">
                                        <label class="form-check-label text-danger" for="remove_logo">
                                            <i class="fas fa-trash mr-1"></i>Hapus logo saat ini
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-3 p-3 border rounded bg-light text-center">
                            <i class="fas fa-building fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Tidak ada logo</p>
                        </div>
                    @endif

                    <!-- New Logo Upload -->
                    <div class="custom-file">
                        <input type="file" 
                               class="custom-file-input @error('logo') is-invalid @enderror" 
                               id="logo" 
                               name="logo" 
                               accept="image/*">
                        <label class="custom-file-label" for="logo">
                            {{ $perusahaan->logo_path ? 'Ganti logo...' : 'Pilih file logo...' }}
                        </label>
                        @error('logo')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">
                        Format: JPG, PNG, GIF. Maksimal: 2MB
                    </small>
                    
                    <!-- Logo Preview -->
                    <div class="mt-3" id="logo-preview-container" style="display: none;">
                        <p class="font-weight-bold text-primary">Pratinjau Logo Baru:</p>
                        <div class="border rounded p-3 text-center" style="max-width: 200px;">
                            <img id="logo-preview" class="img-fluid" style="max-height: 100px;">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-group mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-secondary btn-lg mr-3">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                            <i class="fas fa-save mr-2"></i>Update Perusahaan
                        </button>
                    </div>
                </div>
            </form>
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
        
        .form-control {
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }
        
        .custom-file-label {
            border-radius: 8px;
        }
        
        .custom-file-input:focus ~ .custom-file-label {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .alert {
            border-radius: 8px;
            border: none;
        }
        
        .bg-light {
            background-color: #f8f9fa !important;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Logo preview functionality
            $('#logo').on('change', function() {
                const file = this.files[0];
                const previewContainer = $('#logo-preview-container');
                const preview = $('#logo-preview');
                
                if (file) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        previewContainer.show();
                    }
                    
                    reader.readAsDataURL(file);
                    
                    // Update file label
                    $('.custom-file-label').text(file.name);
                } else {
                    previewContainer.hide();
                    $('.custom-file-label').text('{{ $perusahaan->logo_path ? "Ganti logo..." : "Pilih file logo..." }}');
                }
            });
            
            // Bootstrap file input
            bsCustomFileInput.init();
        });
    </script>
@stop
