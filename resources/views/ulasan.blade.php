@extends('templates/main')

@section('content')
    <div class="container py-4">
        <div class="mb-2">
            <h1 class="fs-3">Ulasan</h1>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Buku</th>
                        <th scope="col">Pengirim</th>
                        <th scope="col">Ulasan</th>
                        <th scope="col">Rating</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku_ulasans as $buku_ulasan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku_ulasan->buku->judul }}</td>
                            <td>{{ $buku_ulasan->user->nama_lengkap }}</td>
                            <td>{{ $buku_ulasan->ulasan }}</td>
                            <td>{{ $buku_ulasan->rating }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="/ulasan/{{ $buku_ulasan->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apa kamu yakin?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
