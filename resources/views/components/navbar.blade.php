<nav class="navbar navbar-expand-lg border-bottom">
    <div class="container">
        @if (auth()->user()->perpus_id != 0)
            <a class="navbar-brand" href="/">{{ auth()->user()->perpus->nama_perpus }}</a>
        @else
            <a class="navbar-brand" href="/">Perpustakaan v1.0</a>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav"
            aria-controls="offcanvasNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <span>{{ auth()->user()->username }}</span>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
    <div class="offcanvas-header">
        @if (auth()->user()->perpus_id != 0)
            <h5 class="offcanvas-title" id="offcanvasNavLabel">{{ auth()->user()->perpus->nama_perpus }}</h5>
        @else
            <h5 class="offcanvas-title" id="offcanvasNavLabel">Perpustakaan v1.0</h5>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/buku">Buku</a></li>
            <li class="nav-item"><a class="nav-link" href="/koleksi_pribadi">Koleksi Pribadi</a></li>
            <li class="nav-item"><a class="nav-link" href="/peminjaman">Peminjaman</a></li>
            @if (auth()->user()->access_level != 'anggota')
                <li class="nav-item"><a class="nav-link" href="/penerbit">Penerbit</a></li>
                <li class="nav-item"><a class="nav-link" href="/laporan">Laporan</a></li>
            @endif
            @if (auth()->user()->access_level == 'admin')
                <li class="nav-item"><a class="nav-link" href="/ulasan">Ulasan</a></li>
                <li class="nav-item"><a class="nav-link" href="/anggota">Anggota</a></li>
                <li class="nav-item"><a class="nav-link" href="/perpustakaan">Perpustakaan</a></li>
            @endif
            <hr class="my-2">
            <li class="nav-item">
                <form action="/logout" method="post">
                    @csrf
                    <button class="nav-link">Sign out</button>
                </form>
            </li>
        </ul>
    </div>
</div>
