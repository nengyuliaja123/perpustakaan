<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan', [
            'peminjaman_selesai' => Peminjaman::where('status_pinjam', 'Selesai')->get(),
            'peminjaman_belum_selesai' => Peminjaman::where('status_pinjam', 'Belum selesai')->get(),
        ]);
    }
    public function filter()
    {
        return view('laporan', [
            'peminjaman_selesai' => Peminjaman::whereBetween('tanggal_kembali', [request()->input('start'), request()->input('end')])
                ->where('status_pinjam', 'Selesai')
                ->get(),
            'peminjaman_belum_selesai' => Peminjaman::whereBetween('tanggal_pinjam', [request()->input('start'), request()->input('end')])
                ->where('status_pinjam', 'Belum selesai')
                ->get(),
        ]);
    }
    public function export()
    {
        if (auth()->user()->access_level == 'admin') {
            $peminjamans = Peminjaman::all();
            $csvFileName = now() . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
            ];

            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Perpustakaan', 'Tanggal pinjam', 'Tanggal kembali', 'Peminjam', 'Status pinjam']); // Add more headers as needed

            foreach ($peminjamans as $peminjaman) {
                fputcsv($handle, [$peminjaman->perpus->nama_perpus, $peminjaman->tanggal_pinjam, $peminjaman->tanggal_kembali, $peminjaman->user->nama_lengkap, $peminjaman->status_pinjam]); // Add more fields as needed
            }

            fclose($handle);

            return Response::make('', 200, $headers);
        }

        $peminjamans = Peminjaman::all();
        $csvFileName = now() . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Tanggal pinjam', 'Tanggal kembali', 'Peminjam', 'Status pinjam']); // Add more headers as needed

        foreach ($peminjamans as $peminjaman) {
            fputcsv($handle, [$peminjaman->tanggal_pinjam, $peminjaman->tanggal_kembali, $peminjaman->user->nama_lengkap, $peminjaman->status_pinjam]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
