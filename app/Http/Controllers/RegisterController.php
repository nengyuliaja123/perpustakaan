<?php

namespace App\Http\Controllers;

use App\Models\Perpus;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'perpuses' => Perpus::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'perpus_id' => ['required'],
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'nama_lengkap' => ['required'],
            'no_hp' => ['required'],
            'alamat' => ['required'],
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['access_level'] = 'anggota';

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }
}
