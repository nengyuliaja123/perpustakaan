@extends('templates/main')

@section('content')
    <div class="container py-4">
        <div class="mb-2">
            <h1 class="fs-3">Peminjaman</h1>
        </div>
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
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if (auth()->user()->access_level == 'admin')
                                <td>{{ $peminjaman->perpus->nama_perpus }}</td>
                            @endif
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_kembali }}</td>
                            @if (auth()->user()->access_level != 'anggota')
                                <td>{{ $peminjaman->user->nama_lengkap }}</td>
                            @endif
                            <td>{{ $peminjaman->status_pinjam }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $peminjaman->id }}"><i class="bi bi-eye"></i></button>
                                    @if (auth()->user()->access_level == 'admin')
                                        @if ($peminjaman->status_pinjam == 'Selesai')
                                            <button type="submit" class="btn btn-sm btn-success" disabled><i
                                                    class="bi bi-check"></i></button>
                                        @else
                                            <form action="/peminjaman/{{ $peminjaman->id }}" method="post">
                                                @method('put')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"><i
                                                        class="bi bi-check"></i></button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        @php
                            $peminjaman_detail = $peminjaman_details->where('peminjaman_id', $peminjaman->id)->first();
                        @endphp
                        <div class="modal fade" id="modal{{ $peminjaman->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Detail Peminjaman</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="nav flex-column">
                                            <li class="nav-item"><strong>Judul:</strong>
                                                {{ $peminjaman_detail->buku->judul }}</li>
                                            <li class="nav-item"><strong>Penulis:</strong>
                                                {{ $peminjaman_detail->buku->penulis }}</li>
                                            <li class="nav-item"><strong>Penerbit:</strong>
                                                {{ $peminjaman_detail->buku->penerbit }}</li>
                                            <li class="nav-item"><strong>Tahun terbit:</strong>
                                                {{ date('Y', strtotime($peminjaman_detail->buku->tahun_terbit)) }}
                                            </li>
                                            <li class="nav-item"><strong>Kategori:</strong>
                                                {{ $peminjaman_detail->buku->bukuKategori->nama_kategori }}
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-secondary me-2"
                                                data-bs-dismiss="modal">Kembali</button>
                                            @if (auth()->user()->access_level == 'admin')
                                                @if ($peminjaman->status_pinjam == 'Selesai')
                                                    <button type="submit" class="btn btn-success disabled">Selesai</button>
                                                @else
                                                    <form action="/peminjaman/{{ $peminjaman->id }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Selesai</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
