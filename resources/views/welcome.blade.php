<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Bursa Kerja Khusus (BKK)</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS (Optional, for minor adjustments) -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
            color: #007bff !important;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://via.placeholder.com/1500x500/007bff/ffffff?text=Background+Image+BKK') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            margin-bottom: 40px;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 30px;
        }
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
            margin-top: 50px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://via.placeholder.com/30x30?text=BKK" alt="Logo BKK" class="d-inline-block align-text-top me-2">
                BKK Sistem
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lowongan">Lowongan Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#perusahaan">Perusahaan Mitra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary ms-lg-2" href="{{ route('register') }}">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-black ms-lg-2" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Selamat Datang di Sistem Informasi BKK</h1>
            <p class="lead">Temukan peluang karir terbaik dan bangun masa depan Anda bersama kami.</p>
            <a href="#lowongan" class="btn btn-primary btn-lg me-2">Lihat Lowongan</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Main Content Sections -->
    <div class="container">
        <!-- Section: Tentang BKK -->
        <section id="tentang" class="mb-5">
            <h2 class="text-center mb-4">Tentang Bursa Kerja Khusus (BKK)</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="text-center">
                        Bursa Kerja Khusus (BKK) adalah lembaga yang dibentuk di Sekolah Menengah Kejuruan (SMK) dan Perguruan Tinggi untuk memfasilitasi penempatan lulusan ke dunia kerja. Kami berkomitmen untuk menjembatani kebutuhan industri dengan talenta-talenta terbaik dari institusi pendidikan.
                    </p>
                    <p class="text-center">
                        Melalui platform ini, kami menyediakan informasi lowongan kerja terkini, profil perusahaan mitra, serta berbagai sumber daya untuk membantu para pencari kerja mempersiapkan diri menghadapi tantangan dunia profesional.
                    </p>
                </div>
            </div>
        </section>

        <hr class="my-5">

        <!-- Section: Lowongan Terbaru -->
        <section id="lowongan" class="mb-5">
            <h2 class="text-center mb-4">Lowongan Kerja Terbaru</h2>
            <div class="row">
                <!-- Contoh Card Lowongan 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Web Developer (Fullstack)</h5>
                            <h6 class="card-subtitle mb-2 text-muted">PT. Teknologi Maju</h6>
                            <p class="card-text">Mencari Web Developer berpengalaman dengan Laravel dan Vue.js. Penempatan Jakarta.</p>
                            <span class="badge bg-info text-dark mb-2">Full-time</span>
                            <span class="badge bg-secondary mb-2">Jakarta</span>
                            <a href="#" class="btn btn-sm btn-outline-primary d-block mt-3">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Contoh Card Lowongan 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Marketing Specialist</h5>
                            <h6 class="card-subtitle mb-2 text-muted">CV. Kreatif Solusi</h6>
                            <p class="card-text">Membutuhkan Marketing Specialist dengan pengalaman digital marketing. Penempatan Bandung.</p>
                            <span class="badge bg-info text-dark mb-2">Full-time</span>
                            <span class="badge bg-secondary mb-2">Bandung</span>
                            <a href="#" class="btn btn-sm btn-outline-primary d-block mt-3">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Contoh Card Lowongan 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Teknisi Jaringan</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Global Network Inc.</h6>
                            <p class="card-text">Dicari Teknisi Jaringan dengan sertifikasi CCNA. Penempatan Surabaya.</p>
                            <span class="badge bg-info text-dark mb-2">Full-time</span>
                            <span class="badge bg-secondary mb-2">Surabaya</span>
                            <a href="#" class="btn btn-sm btn-outline-primary d-block mt-3">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#lowongan" class="btn btn-lg btn-outline-secondary">Lihat Semua Lowongan</a>
            </div>
        </section>

        <hr class="my-5">

        <!-- Section: Perusahaan Mitra -->
        <section id="perusahaan" class="mb-5">
            <h2 class="text-center mb-4">Perusahaan Mitra Kami</h2>
            <div class="row text-center">
                <div class="col-md-3 col-sm-6 mb-4">
                    <img src="https://via.placeholder.com/150x80?text=Company+A" alt="Company A" class="img-fluid rounded shadow-sm p-2">
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <img src="https://via.placeholder.com/150x80?text=Company+B" alt="Company B" class="img-fluid rounded shadow-sm p-2">
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <img src="https://via.placeholder.com/150x80?text=Company+C" alt="Company C" class="img-fluid rounded shadow-sm p-2">
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <img src="https://via.placeholder.com/150x80?text=Company+D" alt="Company D" class="img-fluid rounded shadow-sm p-2">
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-lg btn-outline-secondary">Lihat Semua Mitra</a>
            </div>
        </section>

        <hr class="my-5">

        <!-- Section: Kontak -->
        <section id="kontak" class="mb-5">
            <h2 class="text-center mb-4">Hubungi Kami</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <p class="text-center">
                        Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.
                    </p>
                    <ul class="list-unstyled text-center">
                        <li><i class="bi bi-geo-alt-fill me-2"></i> Alamat: Jl. Contoh No. 123, Kota Anda</li>
                        <li><i class="bi bi-telephone-fill me-2"></i> Telepon: (021) 1234567</li>
                        <li><i class="bi bi-envelope-fill me-2"></i> Email: info@bkk-sistem.com</li>
                    </ul>
                    <!-- Anda bisa menambahkan form kontak di sini -->
                </div>
            </div>
        </section>

    </div> <!-- End of container -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Sistem Informasi BKK. All Rights Reserved.</p>
            <p>
                <a href="#">Kebijakan Privasi</a> |
                <a href="#">Syarat & Ketentuan</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS CDN (Bundle with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons (Optional, for icons like phone, email, location) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>
