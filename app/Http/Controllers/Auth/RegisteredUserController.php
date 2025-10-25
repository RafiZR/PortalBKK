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
use Illuminate\Validation\Rule;
use Illuminate\View\View;


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
            'nik' => ['required', 'string', 'max:255', 'unique:'.User::class], // Ditambahkan
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Validasi untuk kolom-kolom baru
            'no_hp_wa' => ['required', 'string', 'max:20'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat' => ['required', 'string'],
            'jurusan' => ['required', 'string', 'max:255'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'tahun_lulus' => ['required', 'string', 'max:4'], // Contoh: 2023
            'domisili' => ['required', Rule::in(['Kuningan', 'Cirebon'])], // Disesuaikan dengan enum DB
            'npwp' => ['required', 'string', 'max:255'], // Ditambahkan
            'bpjs_kesehatan' => ['required', 'string', 'max:255'], // Ditambahkan
            'berat_badan' => ['nullable', 'string', 'max:255'], // Ditambahkan, nullable sesuai DB
            'tinggi_badan' => ['nullable', 'string', 'max:255'], // Ditambahkan, nullable sesuai DB
            'foto_profile' => ['nullable', 'string', 'max:255'], // Ditambahkan, nullable sesuai DB (asumsi menyimpan path/nama file)
        ]);

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik, // Ditambahkan
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa', // Default role untuk registrasi adalah 'siswa'

            // Simpan kolom-kolom baru
            'no_hp_wa' => $request->no_hp_wa,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            // 'umur' tidak perlu disimpan langsung, akan dihitung oleh model
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'jurusan' => $request->jurusan,
            'asal_sekolah' => $request->asal_sekolah,
            'tahun_lulus' => $request->tahun_lulus,
            'domisili' => $request->domisili,
            'npwp' => $request->npwp, // Ditambahkan
            'bpjs_kesehatan' => $request->bpjs_kesehatan, // Ditambahkan
            'berat_badan' => $request->berat_badan, // Ditambahkan
            'tinggi_badan' => $request->tinggi_badan, // Ditambahkan
            'foto_profile' => $request->foto_profile, // Ditambahkan
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
