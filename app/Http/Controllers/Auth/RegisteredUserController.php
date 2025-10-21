<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule; // Tambahkan ini
use Illuminate\View\View; // Tambahkan baris ini


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Validasi untuk kolom-kolom baru
            'tanggal_lahir' => ['required', 'date'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])], // Validasi ini
            'alamat' => ['required', 'string'],
            'jurusan' => ['required', 'string', 'max:255'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'tahun_lulus' => ['required', 'string', 'max:4'], // Validasi ini
            'asal_bkk' => ['required', Rule::in(['smkn 1 cilimus', 'smkn 2 kuningan', 'smkn 5 kuningan', 'smk pertiwi cilimus', 'lainnya'])],
            'domisili' => ['required', Rule::in(['kuningan', 'cirebon', 'majalengka', 'cilacap', 'lainnya'])],
            'no_hp_wa' => ['required', 'string', 'max:20'], // Validasi ini
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa', // Default role untuk registrasi adalah 'siswa'
            // Simpan kolom-kolom baru
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin, // Simpan ini
            'alamat' => $request->alamat,
            'jurusan' => $request->jurusan,
            'asal_sekolah' => $request->asal_sekolah,
            'tahun_lulus' => $request->tahun_lulus, // Simpan ini
            'asal_bkk' => $request->asal_bkk,
            'domisili' => $request->domisili,
            'no_hp_wa' => $request->no_hp_wa, // Simpan ini
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
