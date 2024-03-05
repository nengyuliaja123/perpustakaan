<?php

namespace App\Http\Controllers;

use App\Models\BukuUlasan;
use App\Models\KoleksiPribadi;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Perpus;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('anggota', [
            'users' => User::whereNot('perpus_id', '0')->get(),
            'perpuses' => Perpus::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ValidatedData = $request->validate([
            'perpus_id' => ['required'],
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'nama_lengkap' => ['required'],
            'no_hp' => ['required'],
            'alamat' => ['required'],
            'access_level' => ['required'],
        ]);

        $ValidatedData['password'] = bcrypt($request->input('password'));

        User::create($ValidatedData);

        return redirect('/anggota');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'perpus_id' => ['required'],
            'nama_lengkap' => ['required'],
            'no_hp' => ['required'],
            'alamat' => ['required'],
            'access_level' => ['required'],
        ];

        if ($request->username != $user->username && $request->email != $user->email) {
            $rules['username'] = ['required', 'unique:users'];
            $rules['email'] = ['required', 'email', 'unique:users'];
        } elseif ($request->username != $user->username && $request->email == $user->email) {
            $rules['username'] = ['required', 'unique:users'];
            $rules['email'] = ['required', 'email'];
        } elseif ($request->username == $user->username && $request->email != $user->email) {
            $rules['username'] = ['required'];
            $rules['email'] = ['required', 'email', 'unique:users'];
        } else {
            $rules['username'] = ['required'];
            $rules['email'] = ['required', 'email'];
        }

        $ValidatedData = $request->validate($rules);

        if ($request->input('password')) {
            $ValidatedData['password'] = bcrypt($request->input('password'));
        }

        User::where('id', $user->id)
            ->update($ValidatedData);

        return redirect('/anggota');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        BukuUlasan::where('user_id', $user->id)->delete();
        KoleksiPribadi::where('user_id', $user->id)->delete();

        $peminjamans = Peminjaman::where('user_id', $user->id)->get();
        foreach ($peminjamans as $peminjaman) {
            PeminjamanDetail::where('peminjaman_id', $peminjaman->id)->delete();
        }
        $peminjamans = Peminjaman::where('user_id', $user->id)->delete();

        return redirect('/anggota');
    }
}
