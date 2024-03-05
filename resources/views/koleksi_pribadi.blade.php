@extends('templates/main')

@section('content')
    <div class="container py-4">
        <div class="mb-4">
            <h1 class="fs-3">Koleksi Pribadi</h1>
        </div>
        <div class="row">
            @foreach ($koleksi_pribadis as $koleksi_pribadi)
                <div class="position-relative col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="/buku/{{ $koleksi_pribadi->buku->id }}" class="text-dark" style="text-decoration: none">
                        <img class="img-fluid shadow-sm mb-2" src="{{ asset('storage/images/noimage.jpg') }}" alt=""
                            style="width:135px;height:180px;object-fit: cover">
                        <h2 class="fs-7 fw-normal mb-4">{{ $koleksi_pribadi->buku->judul }}</h2>
                    </a>
                    <div class="position-absolute top-0 right-0">
                        <form action="/koleksi_pribadi/{{ $koleksi_pribadi->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
