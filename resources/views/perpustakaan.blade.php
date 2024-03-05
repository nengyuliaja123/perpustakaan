@extends('templates/main')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="">
                <h1 class="fs-3">Perpustakaan</h1>
            </div>
            <!-- Button trigger modal tambah -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Tambah Perpustakaan
            </button>
        </div>

        <div class="table-responsive">
            <table class="table overflow-scroll">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama&nbsp;Perpustakaan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perpuses as $perpus)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $perpus->nama_perpus }}</td>
                            <td>{{ $perpus->alamat }}</td>
                            <td>{{ $perpus->tlp_hp }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Button trigger modal edit -->
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $perpus->id }}"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <form action="/perpustakaan/{{ $perpus->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apa kamu yakin?')"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $perpus->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Edit Perpustakaan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/perpustakaan/{{ $perpus->id }}" method="post">
                                            @method('put')
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nama_perpus" class="form-label">Nama perpus</label>
                                                <input type="text"
                                                    class="form-control @error('nama_perpus') is-invalid @enderror"
                                                    id="nama_perpus" name="nama_perpus"
                                                    value="{{ old('nama_perpus', $perpus->nama_perpus) }}">
                                                @error('nama_perpus')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    id="alamat" name="alamat"
                                                    value="{{ old('alamat', $perpus->alamat) }}">
                                                @error('perpusname')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tlp_hp" class="form-label">Telepon</label>
                                                <input type="tlp_hp"
                                                    class="form-control @error('tlp_hp') is-invalid @enderror"
                                                    id="tlp_hp" name="tlp_hp"
                                                    value="{{ old('tlp_hp', $perpus->tlp_hp) }}">
                                                @error('tlp_hp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah Perpustakaan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/perpustakaan" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_perpus" class="form-label">Nama perpus</label>
                                <input type="text" class="form-control @error('nama_perpus') is-invalid @enderror"
                                    id="nama_perpus" name="nama_perpus" value="{{ old('nama_perpus') }}">
                                @error('nama_perpus')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" value="{{ old('alamat') }}">
                                @error('perpusname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tlp_hp" class="form-label">Telepon</label>
                                <input type="tlp_hp" class="form-control @error('tlp_hp') is-invalid @enderror"
                                    id="tlp_hp" name="tlp_hp" value="{{ old('tlp_hp') }}">
                                @error('tlp_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
