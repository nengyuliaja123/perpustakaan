<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        if (auth()->user()->access_level == 'admin') {
            if (request()->input('query')) {
                return view('search', [
                    'bukus' => Buku::where('judul', 'like', '%' . request('query') . '%')->paginate(12)
                ]);
            }
            if (request()->input('penerbit')) {
                return view('search', [
                    'bukus' => Buku::where('penerbit', request()->input('penerbit'))->paginate(12)
                ]);
            }
        }

        if (request()->input('query')) {
            return view('search', [
                'bukus' => Buku::where('judul', 'like', '%' . request('query') . '%')->where('perpus_id', auth()->user()->perpus_id)->paginate(12)
            ]);
        }

        if (request()->input('penerbit')) {
            return view('search', [
                'bukus' => Buku::where('penerbit', request()->input('penerbit'))->where('perpus_id', auth()->user()->perpus_id)->paginate(12)
            ]);
        }
    }
}
