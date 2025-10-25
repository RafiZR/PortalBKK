<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk upload file

class PerusahaanController extends Controller
{
    // Middleware untuk otentikasi admin (sesuaikan dengan setup middleware Anda)
    public function __construct()
    {
        // Pastikan hanya user yang sudah login dan memiliki role admin yang bisa mengakses ini
        // $this->middleware('auth');
        // $this->middleware('admin'); // Contoh middleware 'admin'
    }

    /**
     * Menampilkan daftar semua perusahaan.
     */
    public function index()
    {
        $perusahaan = Perusahaan::orderBy('nama_perusahaan')->paginate(10);
        return view('perusahaan.index', compact('perusahaan'));
    }

    /**
     * Menampilkan form untuk membuat perusahaan baru.
     */
    public function create()
    {
        return view('perusahaan.create');
    }

    /**
     * Menyimpan perusahaan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_perusahaan' => 'nullable|string|max:6|unique:perusahaan',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:perusahaan,email',
            'deskripsi' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);

        $data = $request->except('logo'); // Ambil semua data kecuali logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logos'); // Simpan di storage/app/public/logos
            $data['logo_path'] = Storage::url($logoPath); // Dapatkan URL publiknya
        }

        Perusahaan::create($data);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail perusahaan tertentu.
     */
    public function show(Perusahaan $perusahaan)
    {
        return view('perusahaan.show', compact('perusahaan'));
    }

    /**
     * Menampilkan form untuk mengedit perusahaan.
     */
    public function edit(Perusahaan $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
    }

    /**
     * Memperbarui perusahaan di database.
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        $request->validate([
            'kode_perusahaan' => 'nullable|string|max:6|unique:perusahaan,kode_perusahaan,' . $perusahaan->id,
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:perusahaan,email,' . $perusahaan->id,
            'deskripsi' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($perusahaan->logo_path) {
                Storage::delete(str_replace('/storage', 'public', $perusahaan->logo_path));
            }
            $logoPath = $request->file('logo')->store('public/logos');
            $data['logo_path'] = Storage::url($logoPath);
        } elseif ($request->input('remove_logo')) { // Jika ada checkbox untuk menghapus logo
            if ($perusahaan->logo_path) {
                Storage::delete(str_replace('/storage', 'public', $perusahaan->logo_path));
            }
            $data['logo_path'] = null;
        }

        $perusahaan->update($data);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diperbarui!');
    }

     /**
     * Menghapus perusahaan dari database.
     */
    public function destroy(Perusahaan $perusahaan)
    {
        if ($perusahaan->logo_path) {
            Storage::delete(str_replace('/storage', 'public', $perusahaan->logo_path));
        }
        $perusahaan->delete();
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus!');
    }
    


}
