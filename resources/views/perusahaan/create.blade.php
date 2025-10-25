@extends('adminlte::page')

@section('title', 'Tambah Perusahaan Baru')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">
            <i class="fas fa-plus-circle mr-2"></i>Tambah Perusahaan Baru
        </h1>
        <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary btn-lg">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow border-0">
        <div class="card-header bg-gradient-primary text-white py-3">
            <h5 class="card-title mb-0 font-weight-bold">
                <i class="fas fa-building mr-2"></i>Form Tambah Perusahaan
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

            <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Kode Perusahaan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_perusahaan" class="font-weight-bold text-primary">
                                <i class="fas fa-code mr-1"></i>Kode Perusahaan
                            </label>
                            <input type="text" 
                                   class="form-control rounded-lg border-primary @error('kode_perusahaan') is-invalid @enderror" 
                                   id="kode_perusahaan" 
                                   name="kode_perusahaan" 
                                   value="{{ old('kode_perusahaan') }}" 
                                   placeholder="Kosongkan untuk generate otomatis">
                            @error('kode_perusahaan')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Biarkan kosong untuk kode otomatis
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
                                   value="{{ old('nama_perusahaan') }}" 
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
                              required>{{ old('alamat') }}</textarea>
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
                                   value="{{ old('telepon') }}" 
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
                                   value="{{ old('email') }}" 
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
                           value="{{ old('website') }}" 
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
                              placeholder="Masukkan deskripsi perusahaan">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="form-group">
                    <label for="logo" class="font-weight-bold text-primary">
                        <i class="fas fa-image mr-1"></i>Logo Perusahaan
                    </label>
                    <div class="custom-file">
                        <input type="file" 
                               class="custom-file-input @error('logo') is-invalid @enderror" 
                               id="logo" 
                               name="logo" 
                               accept="image/*">
                        <label class="custom-file-label" for="logo">Pilih file logo...</label>
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
                        <p class="font-weight-bold text-primary">Pratinjau Logo:</p>
                        <div class="border rounded p-3 text-center" style="max-width: 200px;">
                            <img id="logo-preview" class="img-fluid" style="max-height: 100px;">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-group mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary btn-lg mr-3">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                            <i class="fas fa-save mr-2"></i>Simpan Perusahaan
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
                    $('.custom-file-label').text('Pilih file logo...');
                }
            });
            
            // Bootstrap file input
            bsCustomFileInput.init();
        });
    </script>
@stop
