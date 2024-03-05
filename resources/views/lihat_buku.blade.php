@extends('templates/main')

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-block text-truncate">
                <li class="breadcrumb-item d-inline-block"><a href="/">Home</a></li>
                <li class="breadcrumb-item d-inline-block active">Buku</li>
                <li class="breadcrumb-item d-inline-block active" aria-current="page">{{ $buku->judul }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <div class="d-flex">
                    @if ($buku->sampul)
                        <img class="img-fluid mb-2" src="{{ asset('storage/' . $buku->sampul) }}" alt=""
                            style="width:203px;height:270px;object-fit: cover">
                    @else
                        <img class="img-fluid mb-2" src="{{ asset('storage/images/noimage.jpg') }}" alt=""
                            style="width:203px;height:270px;object-fit: cover">
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Judul</td>
                                <td>{{ $buku->judul }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>{{ $buku->bukuKategori->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <td>Penulis</td>
                                <td>{{ $buku->penulis }}</td>
                            </tr>
                            <tr>
                                <td>Penerbit</td>
                                <td>{{ $buku->penerbit }}</td>
                            </tr>
                            <tr>
                                <td>Tahun terbit</td>
                                <td>{{ date('Y', strtotime($buku->tahun_terbit)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-center">
                    @if (auth()->user()->access_level == 'anggota')
                        <!-- Button trigger modal pinjam -->
                        <button type="button" class="btn btn-primary me-4" data-bs-toggle="modal"
                            data-bs-target="#modalPinjam">
                            Pinjam Buku
                        </button>
                        <!-- Modal Pinjam -->
                        <div class="modal fade" id="modalPinjam" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Pinjam Buku</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/peminjaman" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $buku->id }}">
                                            <div class="mb-3">
                                                <label for="tanggal_pinjam" class="form-label">Tanggal pinjam</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                                    id="tanggal_pinjam" name="tanggal_pinjam"
                                                    value="{{ old('tanggal_pinjam') }}">
                                                @error('tanggal_pinjam')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_kembali" class="form-label">Tanggal kembali</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                                    id="tanggal_kembali" name="tanggal_kembali"
                                                    value="{{ old('tanggal_kembali') }}">
                                                @error('tanggal_kembali')
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
                    @endif
                    @if ($buku->isAuthUserKoleksiPribadi())
                        <i class="bi bi-heart-fill text-danger fs-2"></i>
                    @else
                        <form action="/koleksi_pribadi" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $buku->id }}">
                            <button class="btn border-0 p-0">
                                <i class="bi bi-heart fs-2"></i>
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fs-5">Ulasan</h2>
                @if (auth()->user()->access_level == 'anggota')
                    <!-- Button trigger modal pinjam -->
                    <button type="button" class="btn link-primary border-0" data-bs-toggle="modal"
                        data-bs-target="#modalUlasan">
                        Berikan ulasan
                    </button>
                    <!-- Modal Ulasan -->
                    <div class="modal fade" id="modalUlasan" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="/ulasan" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $buku->id }}">
                                        <div class="mb-3 rating">
                                            <label>
                                                <input type="radio" name="rating" id="rating" value="1" />
                                                <span class="icon">★</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="rating" id="rating" value="2" />
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="rating" id="rating" value="3" />
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="rating" id="rating" value="4" />
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="rating" id="rating" value="5" />
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                            </label>
                                        </div>
                                        <script>
                                            $(':radio').change(function() {
                                                console.log('New star rating: ' + this.value);
                                            });
                                        </script>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="ulasan" id="ulasan" rows="6">{{ old('ulasan') }}</textarea>
                                            @error('ulasan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="#" class="btn btn-secondary me-2"
                                                data-bs-dismiss="modal">Batal</a>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @forelse ($buku_ulasans as $buku_ulasan)
                <div class="d-flex">
                    <img class="img-fluid rounded-circle me-3"
                        src="https://ui-avatars.com/api/?name={{ $buku_ulasan->user->nama_lengkap }}" alt=""
                        style="width:60px;height:60px;object-fit: cover">
                    <div class="flex-column">
                        <span class="fw-medium me-2">{{ $buku_ulasan->user->nama_lengkap }}</span>
                        <span><i class="bi bi-star-fill text-warning"></i>
                            {{ $buku_ulasan->rating }}</span>
                        <p class="mt-2">{{ $buku_ulasan->ulasan }}</p>
                    </div>
                </div>
            @empty
                <p>Tidak ada ulasan.</p>
            @endforelse
        </div>
        <div class="mt-4">
            <h2 class="fs-5">Koleksi Lainnya</h2>
            <div class="row mt-4">
                @forelse ($koleksi_lainnya as $row)
                    <div class="col-md-6 col-lg-3 text-center">
                        <a href="/buku/{{ $row->id }}" class="text-dark" style="text-decoration: none">
                            @if ($buku->sampul)
                                <img class="img-fluid mb-2" src="{{ asset('storage/' . $buku->sampul) }}" alt=""
                                    style="width:203px;height:270px;object-fit: cover">
                            @else
                                <img class="img-fluid mb-2" src="{{ asset('storage/images/noimage.jpg') }}"
                                    alt="" style="width:203px;height:270px;object-fit: cover">
                            @endif
                            <h2 class="fs-6 fw-normal mb-4">{{ $row->judul }}</h2>
                        </a>
                    </div>
                @empty
                    <p>Tidak ada koleksi lainnya.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
