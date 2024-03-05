@extends('templates/main')

@section('content')
    <div class="container py-4">
        <div class="mb-2">
            <h1 class="fs-3">Penerbit</h1>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="/search" method="get">
                                        @csrf
                                        <input type="hidden" name="penerbit" value="{{ $buku->penerbit }}">
                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                class="bi bi-eye"></i></button>
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
