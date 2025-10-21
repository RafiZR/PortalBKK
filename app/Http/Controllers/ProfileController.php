<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat' => 'required|string',
            'jurusan' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'tahun_lulus' => ['required', 'string', 'max:4'],
            'asal_bkk' => ['required', Rule::in(['smkn 1 cilimus', 'smkn 2 kuningan', 'smkn 5 kuningan', 'smk pertiwi cilimus', 'lainnya'])],
            'domisili' => ['required', Rule::in(['kuningan', 'cirebon', 'majalengka', 'cilacap', 'lainnya'])],
            'no_hp_wa' => ['required', 'string', 'max:20'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->alamat = $request->alamat;
        $user->jurusan = $request->jurusan;
        $user->asal_sekolah = $request->asal_sekolah;
        $user->tahun_lulus = $request->tahun_lulus;
        $user->asal_bkk = $request->asal_bkk;
        $user->domisili = $request->domisili;
        $user->no_hp_wa = $request->no_hp_wa;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
