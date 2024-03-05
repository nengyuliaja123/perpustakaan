@extends('templates/main')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="">
                <h1 class="fs-3">Buku</h1>
            </div>
            <!-- Button trigger modal tambah -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Tambah Buku
            </button>
        </div>

        <div class="table-responsive">
            <table class="table overflow-scroll">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        @if (auth()->user()->access_level == 'admin')
                            <th scope="col">Perpustakaan</th>
                        @endif
                        <th scope="col">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun&nbsp;terbit</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if (auth()->user()->access_level == 'admin')
                                <td>{{ $buku->perpus->nama_perpus }}</td>
                            @endif
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->bukuKategori->nama_kategori }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>{{ date('Y', strtotime($buku->tahun_terbit)) }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Button trigger modal edit -->
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $buku->id }}"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <form action="/buku/{{ $buku->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apa kamu yakin?')"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $buku->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Edit Buku</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/buku/{{ $buku->id }}" method="post"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            @if (auth()->user()->access_level == 'admin')
                                                <div class="mb-3">
                                                    <label for="perpus_id" class="form-label">Perpustakaan</label>
                                                    <select class="form-control @error('perpus_id') is-invalid @enderror"
                                                        id="perpus_id" name="perpus_id">
                                                        @foreach ($perpuses as $perpus)
                                                            @if (old('perpus_id', $buku->perpus_id) == $perpus->id)
                                                                <option value="{{ $perpus->id }}" selected>
                                                                    {{ $perpus->nama_perpus }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $perpus->id }}">
                                                                    {{ $perpus->nama_perpus }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('perpus_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="judul" class="form-label">Judul</label>
                                                <input type="text"
                                                    class="form-control @error('judul') is-invalid @enderror" id="judul"
                                                    name="judul" value="{{ old('judul', $buku->judul) }}">
                                                @error('judul')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="sampul" class="form-label">Sampul</label><br>
                                                @if ($buku->sampul)
                                                    <img src="{{ asset('storage/' . $buku->sampul) }}"
                                                        class="editImgPreview img-fluid mb-3" style="height: 203px;">
                                                @else
                                                    <img class="editImgPreview img-fluid mb-3"
                                                        style="display: none; height: 203px;">
                                                @endif
                                                <input type="file"
                                                    class="form-control @error('sampul') is-invalid @enderror"
                                                    id="sampulEdit" name="sampul" onchange="editPreviewImage()">
                                                @error('sampul')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori_id" class="form-label">Kategori</label>
                                                <select class="form-control @error('kategori_id') is-invalid @enderror"
                                                    id="kategori_id" name="kategori_id">
                                                    @foreach ($bukuKategoris as $bukuKategori)
                                                        @if (old('kategori_id', $buku->kategori_id) == $bukuKategori->id)
                                                            <option value="{{ $bukuKategori->id }}" selected>
                                                                {{ $bukuKategori->nama_kategori }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $bukuKategori->id }}">
                                                                {{ $bukuKategori->nama_kategori }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('kategori_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="text-end">
                                                <button type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#tambah_kategori" aria-expanded="false"
                                                    aria-controls="tambah_kategori" class="btn bg-transparent border-0">+
                                                    Tambah Kategori</button>
                                            </div>
                                            <div class="collapse" id="tambah_kategori">
                                                <div class="mb-3">
                                                    <label for="nama_kategori" class="form-label">Nama kategori</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_kategori') is-invalid @enderror"
                                                        id="nama_kategori" name="nama_kategori"
                                                        value="{{ old('nama_kategori') }}">
                                                    @error('nama_kategori')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="penulis" class="form-label">Penulis</label>
                                                <input type="text"
                                                    class="form-control @error('penulis') is-invalid @enderror"
                                                    id="penulis" name="penulis"
                                                    value="{{ old('penulis', $buku->penulis) }}">
                                                @error('penulis')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="penerbit" class="form-label">Penerbit</label>
                                                <input type="text"
                                                    class="form-control @error('penerbit') is-invalid @enderror"
                                                    id="penerbit" name="penerbit"
                                                    value="{{ old('penerbit', $buku->penerbit) }}">
                                                @error('penerbit')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tahun_terbit" class="form-label">Tahun terbit</label>
                                                <input type="date"
                                                    class="form-control @error('tahun_terbit') is-invalid @enderror"
                                                    id="tahun_terbit" name="tahun_terbit"
                                                    value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                                                @error('tahun_terbit')
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
                        <h1 class="modal-title fs-5">Tambah Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/buku" method="post" enctype="multipart/form-data">
                            @csrf
                            @if (auth()->user()->access_level == 'admin')
                                <div class="mb-3">
                                    <label for="perpus_id" class="form-label">Perpustakaan</label>
                                    <select class="form-control @error('perpus_id') is-invalid @enderror" id="perpus_id"
                                        name="perpus_id">
                                        @foreach ($perpuses as $perpus)
                                            @if (old('perpus_id') == $perpus->id)
                                                <option value="{{ $perpus->id }}" selected>
                                                    {{ $perpus->nama_perpus }}
                                                </option>
                                            @else
                                                <option value="{{ $perpus->id }}">
                                                    {{ $perpus->nama_perpus }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('perpus_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="sampul" class="form-label">Sampul</label>
                                <img class="createImgPreview img-fluid mb-3" style="display: none; height: 203px;">
                                <input type="file" class="form-control @error('sampul') is-invalid @enderror"
                                    id="sampulCreate" name="sampul" onchange="createPreviewImage()">
                                @error('sampul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id"
                                    name="kategori_id">
                                    @foreach ($bukuKategoris as $bukuKategori)
                                        @if (old('kategori_id') == $bukuKategori->id)
                                            <option value="{{ $bukuKategori->id }}" selected>
                                                {{ $bukuKategori->nama_kategori }}
                                            </option>
                                        @else
                                            <option value="{{ $bukuKategori->id }}">
                                                {{ $bukuKategori->nama_kategori }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="button" data-bs-toggle="collapse" data-bs-target="#tambah_kategori"
                                    aria-expanded="false" aria-controls="tambah_kategori"
                                    class="btn bg-transparent border-0">+
                                    Tambah Kategori</button>
                            </div>
                            <div class="collapse" id="tambah_kategori">
                                <div class="mb-3">
                                    <label for="nama_kategori" class="form-label">Nama kategori</label>
                                    <input type="text"
                                        class="form-control @error('nama_kategori') is-invalid @enderror"
                                        id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}">
                                    @error('nama_kategori')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control @error('penulis') is-invalid @enderror"
                                    id="penulis" name="penulis" value="{{ old('penulis') }}">
                                @error('penulis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                    id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
                                @error('penerbit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tahun_terbit" class="form-label">Tahun terbit</label>
                                <input type="date" class="form-control @error('tahun_terbit') is-invalid @enderror"
                                    id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
                                @error('tahun_terbit')
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
    <script>
        function createPreviewImage() {
            const samppul = document.querySelector('#sampulCreate');
            const imgPreview = document.querySelector('.createImgPreview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(samppul.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function editPreviewImage() {
            const sampul = document.querySelector('#sampulEdit');
            const imgPreview = document.querySelector('.editImgPreview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(sampul.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
