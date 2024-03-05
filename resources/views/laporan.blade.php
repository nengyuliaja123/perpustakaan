@extends('templates/main')

@section('content')
    <div class="container py-4">
        <div class="d-lg-flex align-items-center justify-content-between mb-2">
            <div class="">
                <h1 class="fs-3">Laporan</h1>
            </div>
            <form class="d-lg-flex align-items-center" action="/laporan/filter" method="get">
                @csrf
                <div class="d-flex align-items-center gap-2 me-2 mb-3">
                    <label for="start">Start</label>
                    <input class="form-control" type="date" name="start" id="start">
                </div>
                <div class="d-flex align-items-center gap-2 me-2 mb-3">
                    <label for="end">End</label>
                    <input class="form-control" type="date" name="end" id="end">
                </div>
                <div class="text-end mb-3">
                    <button class="btn btn-primary">Filter</button>
                    <a href="/laporan/export" class="btn btn-outline-secondary">Export</a>
                </div>
            </form>
        </div>
        <h2 class="fs-6">Peminjaman Selesai</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        @if (auth()->user()->access_level == 'admin')
                            <th scope="col">Perpustakaan</th>
                        @endif
                        <th scope="col">Tanggal pinjam</th>
                        <th scope="col">Tanggal kembali</th>
                        @if (auth()->user()->access_level != 'anggota')
                            <th scope="col">Peminjam</th>
                        @endif
                        <th scope="col">Status pinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman_selesai as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if (auth()->user()->access_level == 'admin')
                                <td>{{ $row->perpus->nama_perpus }}</td>
                            @endif
                            <td>{{ $row->tanggal_pinjam }}</td>
                            <td>{{ $row->tanggal_kembali }}</td>
                            @if (auth()->user()->access_level != 'anggota')
                                <td>{{ $row->user->nama_lengkap }}</td>
                            @endif
                            <td>{{ $row->status_pinjam }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h2 class="fs-6">Peminjaman Belum Selesai</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        @if (auth()->user()->access_level == 'admin')
                            <th scope="col">Perpustakaan</th>
                        @endif
                        <th scope="col">Tanggal pinjam</th>
                        <th scope="col">Tanggal kembali</th>
                        @if (auth()->user()->access_level != 'anggota')
                            <th scope="col">Peminjam</th>
                        @endif
                        <th scope="col">Status pinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman_belum_selesai as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if (auth()->user()->access_level == 'admin')
                                <td>{{ $row->perpus->nama_perpus }}</td>
                            @endif
                            <td>{{ $row->tanggal_pinjam }}</td>
                            <td>{{ $row->tanggal_kembali }}</td>
                            @if (auth()->user()->access_level != 'anggota')
                                <td>{{ $row->user->nama_lengkap }}</td>
                            @endif
                            <td>{{ $row->status_pinjam }}</td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection
