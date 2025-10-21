<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;
use Illuminate\Http\Request;

class LowonganKerjaController extends Controller
{
    // Middleware agar hanya admin yang bisa akses (opsional)
    public function __construct()
    {
        $this->middleware('auth');
        // Bisa ditambah middleware role admin jika ada
    }

    // Tampilkan daftar lowongan kerja
    public function index()
    {
        $lowongans = LowonganKerja::orderBy('tanggal_buka', 'desc')->paginate(10);
        return view('lowongan.index', compact('lowongans'));
    }

    // Tampilkan form buat lowongan baru
    public function create()
    {
        return view('lowongan.create');
    }

    // Simpan data lowongan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'kontak_perusahaan' => 'required|string|max:100',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after_or_equal:tanggal_buka',
        ]);

        LowonganKerja::create($request->all());

        return redirect()->route('lowongan.index')->with('success', 'Lowongan kerja berhasil ditambahkan.');
    }

    // Tampilkan detail lowongan
    public function show(LowonganKerja $lowongan)
    {
        return view('lowongan.show', compact('lowongan'));
    }

    // Tampilkan form edit lowongan
    public function edit(LowonganKerja $lowongan)
    {
        return view('lowongan.edit', compact('lowongan'));
    }

    // Update data lowongan
    public function update(Request $request, LowonganKerja $lowongan)
    {
        $request->validate([
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'kontak_perusahaan' => 'required|string|max:100',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after_or_equal:tanggal_buka',
        ]);

        $lowongan->update($request->all());

        return redirect()->route('lowongan.index')->with('success', 'Lowongan kerja berhasil diupdate.');
    }

    // Hapus lowongan
    public function destroy(LowonganKerja $lowongan)
    {
        $lowongan->delete();

        return redirect()->route('lowongan.index')->with('success', 'Lowongan kerja berhasil dihapus.');
    }

    public function pelamar($id)
    {
        $lowongan = LowonganKerja::with('pelamar.user')->findOrFail($id);
        return view('lowongan.pelamar', compact('lowongan'));
    }

}
