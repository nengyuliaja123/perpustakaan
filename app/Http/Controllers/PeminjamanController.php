<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->access_level == 'admin') {
            return view('peminjaman', [
                'peminjamans' => Peminjaman::all(),
                'peminjaman_details' => PeminjamanDetail::all()
            ]);
        }
        if (auth()->user()->access_level == 'petugas') {
            return view('peminjaman', [
                'peminjamans' => Peminjaman::where('perpus_id', auth()->user()->perpus_id)->get(),
                'peminjaman_details' => PeminjamanDetail::all()
            ]);
        }
        if (auth()->user()->access_level == 'anggota') {
            return view('peminjaman', [
                'peminjamans' => Peminjaman::where('user_id', auth()->user()->id)->get(),
                'peminjaman_details' => PeminjamanDetail::all()
            ]);
        }
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
            'tanggal_pinjam' => ['required'],
            'tanggal_kembali' => ['required'],
        ]);

        $ValidatedData['perpus_id'] = auth()->user()->perpus_id;
        $ValidatedData['user_id'] = auth()->user()->id;
        $ValidatedData['status_pinjam'] = 'Belum selesai';

        Peminjaman::create($ValidatedData);

        PeminjamanDetail::create([
            'peminjaman_id' => Peminjaman::orderBy('id', 'desc')->first()->id,
            'buku_id' => request()->input('id')
        ]);

        return redirect('/buku/' . request()->input('id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {

        Peminjaman::where('id', $peminjaman->id)->update([
            'status_pinjam' => 'Selesai'
        ]);

        return redirect('/peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
