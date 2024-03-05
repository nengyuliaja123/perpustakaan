<?php

namespace App\Http\Controllers;

use App\Models\KoleksiPribadi;
use Illuminate\Http\Request;

class KoleksiPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koleksi_pribadi', [
            'koleksi_pribadis' => KoleksiPribadi::where('user_id', auth()->user()->id)->get()
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
        KoleksiPribadi::create([
            'user_id' => auth()->user()->id,
            'buku_id' => request()->input('id')
        ]);

        return redirect('/buku/' . request()->input('id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(KoleksiPribadi $koleksiPribadi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KoleksiPribadi $koleksiPribadi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KoleksiPribadi $koleksiPribadi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KoleksiPribadi $koleksiPribadi)
    {
        KoleksiPribadi::destroy($koleksiPribadi->id);

        return redirect('/koleksi_pribadi');
    }
}
