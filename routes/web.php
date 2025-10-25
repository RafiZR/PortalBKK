<?php

use App\Http\Controllers\LowonganKerjaController;
use App\Http\Controllers\PelamarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerusahaanController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php'; // Perbaiki DIR menjadi __DIR__

// Route admin untuk Lowongan Kerja DAN Perusahaan
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Rute untuk Lowongan Kerja
    Route::resource('lowongan', LowonganKerjaController::class);
    Route::get('lowongan/{lowongan}/pelamar', [LowonganKerjaController::class, 'pelamar'])->name('lowongan.pelamar');

    // Rute untuk Perusahaan (CRUD) <-- TAMBAHKAN INI
    Route::resource('perusahaan', PerusahaanController::class);
});

// Route siswa untuk melihat lowongan dan melamar
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/lowongan', [PelamarController::class, 'listLowongan'])->name('pelamar.list_lowongan');
    Route::get('/lowongan/{lowongan}', [PelamarController::class, 'showLowongan'])->name('pelamar.show_lowongan');
    Route::post('/lowongan/{lowongan}/apply', [PelamarController::class, 'apply'])->name('pelamar.apply');
    Route::get('/status-lamaran', [PelamarController::class, 'status'])->name('pelamar.status');
    // Perhatikan: Anda memiliki rute profile di sini juga, pastikan tidak duplikat dengan yang di atas
    // atau jika memang sengaja untuk role siswa, pastikan penanganannya berbeda
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Rute ini sudah termasuk dalam grup admin di atas, jadi bisa dihapus
// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::resource('lowongan', LowonganKerjaController::class);
//     Route::get('lowongan/{lowongan}/pelamar', [LowonganKerjaController::class, 'pelamar'])->name('lowongan.pelamar');
// });

Route::put('pelamar/{id}/update-status', [PelamarController::class, 'updateStatus'])->name('pelamar.update_status')->middleware(['auth', 'role:admin']);

