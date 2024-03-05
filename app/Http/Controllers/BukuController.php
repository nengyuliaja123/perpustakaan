<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\BukuKategori;
use App\Models\BukuUlasan;
use App\Models\KoleksiPribadi;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Perpus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->access_level == 'admin') {
            return view('buku', [
                'bukus' => Buku::all(),
                'perpuses' => Perpus::all(),
                'bukuKategoris' => BukuKategori::all()
            ]);
        }
        if (auth()->user()->access_level == 'petugas') {
            return view('buku', [
                'bukus' => Buku::where('perpus_id', auth()->user()->perpus_id)->get(),
                'bukuKategoris' => BukuKategori::all()
            ]);
        }
        if (auth()->user()->access_level == 'anggota') {
            return view('home', [
                'bukus' => Buku::where('perpus_id', auth()->user()->perpus_id)->orderBy('id', 'desc')->paginate(12),
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
        if (auth()->user()->access_level == 'admin') {
            if ($request->input('nama_kategori')) {
                $ValidatedData = $request->validate([
                    'nama_kategori' => ['required'],
                ]);

                BukuKategori::create($ValidatedData);

                $ValidatedData = $request->validate([
                    'perpus_id' => ['required'],
                    'judul' => ['required'],
                    'penulis' => ['required'],
                    'penerbit' => ['required'],
                    'tahun_terbit' => ['required'],
                    'sampul' => ['image', 'file'],
                ]);

                if ($request->file('sampul')) {
                    $ValidatedData['sampul'] = $request->file('sampul')->store('images');
                }

                $ValidatedData['kategori_id'] = BukuKategori::where('nama_kategori', $request->input('nama_kategori'))->first()->id;

                Buku::create($ValidatedData);

                return redirect('/buku');
            } else {
                $ValidatedData = $request->validate([
                    'perpus_id' => ['required'],
                    'judul' => ['required'],
                    'penulis' => ['required'],
                    'penerbit' => ['required'],
                    'tahun_terbit' => ['required'],
                    'sampul' => ['image', 'file'],
                    'kategori_id' => ['required'],
                ]);

                if ($request->file('sampul')) {
                    $ValidatedData['sampul'] = $request->file('sampul')->store('images');
                }

                Buku::create($ValidatedData);

                return redirect('/buku');
            }
        }

        if ($request->input('nama_kategori')) {
            $ValidatedData = $request->validate([
                'nama_kategori' => ['required'],
            ]);

            BukuKategori::create($ValidatedData);

            $ValidatedData = $request->validate([
                'judul' => ['required'],
                'penulis' => ['required'],
                'penerbit' => ['required'],
                'tahun_terbit' => ['required'],
                'sampul' => ['image', 'file'],
            ]);

            if ($request->file('sampul')) {
                $ValidatedData['sampul'] = $request->file('sampul')->store('images');
            }

            $ValidatedData['perpus_id'] = auth()->user()->perpus_id;
            $ValidatedData['kategori_id'] = BukuKategori::where('nama_kategori', $request->input('nama_kategori'))->first()->id;

            Buku::create($ValidatedData);

            return redirect('/buku');
        } else {
            $ValidatedData = $request->validate([
                'judul' => ['required'],
                'penulis' => ['required'],
                'penerbit' => ['required'],
                'tahun_terbit' => ['required'],
                'sampul' => ['image', 'file'],
                'kategori_id' => ['required'],
            ]);

            if ($request->file('sampul')) {
                $ValidatedData['sampul'] = $request->file('sampul')->store('images');
            }

            $ValidatedData['perpus_id'] = auth()->user()->perpus_id;

            Buku::create($ValidatedData);

            return redirect('/buku');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        return view('lihat_buku', [
            'buku' => $buku,
            'koleksi_lainnya' => Buku::where('kategori_id', $buku->kategori_id)->paginate(6),
            'buku_ulasans' => BukuUlasan::where('buku_id', $buku->id)->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        if (auth()->user()->access_level == 'admin') {
            if ($request->input('nama_kategori')) {
                $ValidatedData = $request->validate([
                    'nama_kategori' => ['required'],
                ]);

                BukuKategori::create($ValidatedData);

                $ValidatedData = $request->validate([
                    'judul' => ['required'],
                    'penulis' => ['required'],
                    'penerbit' => ['required'],
                    'tahun_terbit' => ['required'],
                    'image' => ['image', 'file'],
                ]);

                if ($request->file('sampul')) {
                    if ($buku->sampul) {
                        Storage::delete($buku->sampul);
                    }
                    $ValidatedData['sampul'] = $request->file('sampul')->store('images');
                }

                $ValidatedData['kategori_id'] = BukuKategori::where('nama_kategori', $request->input('nama_kategori'))->first()->id;

                Buku::where('id', $buku->id)
                    ->update($ValidatedData);

                return redirect('/buku');
            } else {
                $ValidatedData = $request->validate([
                    'judul' => ['required'],
                    'penulis' => ['required'],
                    'penerbit' => ['required'],
                    'tahun_terbit' => ['required'],
                    'image' => ['image', 'file'],
                    'kategori_id' => ['required'],
                ]);

                if ($request->file('sampul')) {
                    if ($buku->sampul) {
                        Storage::delete($buku->sampul);
                    }
                    $ValidatedData['sampul'] = $request->file('sampul')->store('images');
                }

                Buku::where('id', $buku->id)->update($ValidatedData);

                return redirect('/buku');
            }
        }

        if ($request->input('nama_kategori')) {
            $ValidatedData = $request->validate([
                'nama_kategori' => ['required'],
            ]);

            BukuKategori::create($ValidatedData);

            $ValidatedData = $request->validate([
                'judul' => ['required'],
                'penulis' => ['required'],
                'penerbit' => ['required'],
                'tahun_terbit' => ['required'],
                'image' => ['image', 'file'],
            ]);

            if ($request->file('sampul')) {
                if ($buku->sampul) {
                    Storage::delete($buku->sampul);
                }
                $ValidatedData['sampul'] = $request->file('sampul')->store('images');
            }

            $ValidatedData['kategori_id'] = BukuKategori::where('nama_kategori', $request->input('nama_kategori'))->first()->id;

            Buku::where('id', $buku->id)
                ->update($ValidatedData);

            return redirect('/buku');
        } else {
            $ValidatedData = $request->validate([
                'judul' => ['required'],
                'penulis' => ['required'],
                'penerbit' => ['required'],
                'tahun_terbit' => ['required'],
                'image' => ['image', 'file'],
                'kategori_id' => ['required'],
            ]);

            if ($request->file('sampul')) {
                if ($buku->sampul) {
                    Storage::delete($buku->sampul);
                }
                $ValidatedData['sampul'] = $request->file('sampul')->store('images');
            }

            Buku::where('id', $buku->id)->update($ValidatedData);

            return redirect('/buku');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        if ($buku->sampul) {
            Storage::delete($buku->sampul);
        }
        Buku::destroy($buku->id);
        BukuUlasan::where('buku_id', $buku->id)->delete();
        KoleksiPribadi::where('buku_id', $buku->id)->delete();

        $peminjaman_details = PeminjamanDetail::where('buku_id', $buku->id)->get();
        foreach ($peminjaman_details as $peminjaman_detail) {
            Peminjaman::where('id', $peminjaman_detail->peminjaman_id)->delete();
        }
        $peminjaman_details = PeminjamanDetail::where('buku_id', $buku->id)->delete();

        return redirect('/buku');
    }
}
