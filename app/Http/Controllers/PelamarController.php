<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\LowonganKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelamarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan daftar lowongan untuk siswa melamar
    public function listLowongan()
    {
        $lowongans = LowonganKerja::where('tanggal_tutup', '>=', now())
            ->orderBy('tanggal_buka', 'desc')
            ->paginate(10);
        return view('pelamar.list_lowongan', compact('lowongans'));
    }

    // Tampilkan detail lowongan untuk melamar
    public function showLowongan(LowonganKerja $lowongan)
    {
        return view('pelamar.show_lowongan', compact('lowongan'));
    }

    // Proses melamar lowongan
    public function apply(LowonganKerja $lowongan)
    {
        $user = Auth::user();

        // Cek apakah sudah melamar
        $alreadyApplied = Pelamar::where('user_id', $user->id)
            ->where('lowongan_id', $lowongan->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'Anda sudah melamar lowongan ini.');
        }

        Pelamar::create([
            'user_id' => $user->id,
            'lowongan_id' => $lowongan->id,
            'status_lamaran' => 'pending',
            'tanggal_lamar' => now()->toDateString(),
        ]);

        return redirect()->route('pelamar.status')->with('success', 'Lamaran berhasil dikirim.');
    }

    // Tampilkan status lamaran siswa
    public function status()
    {
        $user = Auth::user();
        $lamaran = Pelamar::with('lowonganKerja')->where('user_id', $user->id)->paginate(10);
        return view('pelamar.status', compact('lamaran'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $pelamar = Pelamar::findOrFail($id);
        $pelamar->status_lamaran = $request->status;
        $pelamar->save();

        return back()->with('success', 'Status lamaran berhasil diupdate.');
    }


}
