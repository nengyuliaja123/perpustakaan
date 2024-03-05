@extends('templates/main')

@section('content')
    <div class="container py-4">
        <div class="d-none d-lg-flex justify-content-end mb-4">
            <div class="col-md-4">
                <form class="d-flex" action="/search" role="search" method="get">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search" name="query">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
        <div class="row">
            @forelse ($bukus as $buku)
                <div class="col-md-6 col-lg-3 text-center">
                    <a href="/buku/{{ $buku->id }}" class="text-dark" style="text-decoration: none">
                        @if ($buku->sampul)
                            <img class="img-fluid mb-2" src="{{ asset('storage/' . $buku->sampul) }}" alt=""
                                style="width:203px;height:270px;object-fit: cover">
                        @else
                            <img class="img-fluid mb-2" src="{{ asset('storage/images/noimage.jpg') }}" alt=""
                                style="width:203px;height:270px;object-fit: cover">
                        @endif
                        <h2 class="fs-6 fw-normal mb-4">{{ $buku->judul }}</h2>
                    </a>
                </div>
            @empty
                <p>Tidak ada buku.</p>
            @endforelse
            {{ $bukus->links() }}
        </div>
    </div>
@endsection
