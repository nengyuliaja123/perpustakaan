<ul class="nav flex-column py-4">
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
