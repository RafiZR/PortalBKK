<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class ProfileController extends Controller
{
    /**
     * Display the user's profile editing form.
     */
    public function edit(): \Illuminate\View\View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        // Validasi data
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'no_hp_wa' => ['required', 'string', 'max:20'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat' => ['required', 'string'],
            'jurusan' => ['required', 'string', 'max:255'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'tahun_lulus' => ['required', 'string', 'max:4'],
            'domisili' => ['required', Rule::in(['Kuningan', 'Cirebon'])], // Pastikan sesuai enum DB
            'npwp' => ['required', 'string', 'max:255'],
            'bpjs_kesehatan' => ['required', 'string', 'max:255'],
            'berat_badan' => ['nullable', 'string', 'max:255'],
            'tinggi_badan' => ['nullable', 'string', 'max:255'],
            'foto_profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validasi untuk file gambar
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ];

        $validatedData = $request->validate($rules);

        // Hapus password dan password_confirmation dari data jika kosong
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
            unset($validatedData['password_confirmation']); // Pastikan ini juga dihapus jika ada
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // Handle foto_profile upload
        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
            }
            // Simpan foto baru
            $validatedData['foto_profile'] = $request->file('foto_profile')->store('profile-photos', 'public');
        }

        // Update user data
        $user->fill($validatedData);

        // Jika email berubah dan belum diverifikasi, reset email_verified_at
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
