<?php

namespace App\Http\Controllers;

use App\Models\BukuUlasan;
use Illuminate\Http\Request;

class BukuUlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ulasan', [
            'buku_ulasans' => BukuUlasan::all()
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
            'ulasan' => ['required'],
        ]);

        $ValidatedData['buku_id'] = $request->input('id');
        $ValidatedData['user_id'] = auth()->user()->id;

        if ($request->input('rating')) {
            $ValidatedData['rating'] = $request->input('rating');
        } else {
            $ValidatedData['rating'] = 0;
        }

        BukuUlasan::create($ValidatedData);

        return redirect('/buku/' . $request->input('id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(BukuUlasan $bukuUlasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BukuUlasan $bukuUlasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BukuUlasan $bukuUlasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BukuUlasan $bukuUlasan)
    {
        BukuUlasan::destroy($bukuUlasan->id);

        return redirect('/ulasan');
    }
}
