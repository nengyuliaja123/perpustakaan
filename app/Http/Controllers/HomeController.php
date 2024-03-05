<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->access_level == 'admin') {
            return view('home', [
                'bukus' => Buku::orderBy('id', 'desc')->paginate(12),
            ]);
        }

        return view('home', [
            'bukus' => Buku::where('perpus_id', auth()->user()->perpus_id)->orderBy('id', 'desc')->paginate(12),
        ]);
    }
}
