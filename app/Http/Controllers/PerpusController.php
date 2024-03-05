<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\BukuUlasan;
use App\Models\KoleksiPribadi;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Perpus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerpusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('perpustakaan', [
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
            'nama_perpus' => ['required'],
            'alamat' => ['required'],
            'tlp_hp' => ['required'],
        ]);

        Perpus::create($ValidatedData);

        return redirect('/perpustakaan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Perpus $perpus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perpus $perpus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perpus $perpus)
    {
        $ValidatedData = $request->validate([
            'nama_perpus' => ['required'],
            'alamat' => ['required'],
            'tlp_hp' => ['required'],
        ]);

        Perpus::where('id', $perpus->id)->update($ValidatedData);

        return redirect('/perpustakaan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perpus $perpus)
    {
        Perpus::destroy($perpus->id);

        $users = User::where('perpus_id', $perpus->id)->get();
        foreach ($users as $user) {
            KoleksiPribadi::where('user_id', $user->id)->delete();
            BukuUlasan::where('user_id', $user->id)->delete();

            $peminjamans = Peminjaman::where('user_id', $user->id)->get();
            foreach ($peminjamans as $peminjaman) {
                PeminjamanDetail::where('peminjaman_id', $peminjaman->id);
            }
            $peminjamans = Peminjaman::where('user_id', $user->id)->delete();
        }
        $users = User::where('perpus_id', $perpus->id)->delete();

        $bukus = Buku::where('perpus_id', $perpus->id)->get();
        foreach ($bukus as $buku) {
            if ($buku->sampul) {
                Storage::delete($buku->sampul);
            }
            KoleksiPribadi::where('buku_id', $buku->id)->delete();
            BukuUlasan::where('buku_id', $buku->id)->delete();

            $peminjaman_details = PeminjamanDetail::where('buku_id', $buku->id)->get();
            foreach ($peminjaman_details as $peminjaman_detail) {
                Peminjaman::where('id', $peminjaman_detail->peminjaman_id)->delete();
            }
            $peminjaman_details = PeminjamanDetail::where('buku_id', $buku->id)->delete();
        }
        $bukus = Buku::where('perpus_id', $perpus->id)->delete();

        return redirect('/perpustakaan');
    }
}
