<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register · Perpustakaan v1.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="/css/login.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-login w-100 m-auto">
        <form action="/register" method="post">
            @csrf
            <h1 class="h4 mb-3 fw-medium mb-5 text-center">Perpustakaan v1.0</h1>

            <div class="form-floating">
                <select data-position="first" class="form-control @error('perpus_id') is-invalid @enderror"
                    name="perpus_id" id="perpus_id">
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
                <label for="perpus_id">Perpustakaan</label>
            </div>
            <div class="form-floating">
                <input data-position="midle" type="text"
                    class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap"
                    name="nama_lengkap" placeholder="Nama lengkap">
                <label for="nama_lengkap">Nama lengkap</label>
            </div>
            <div class="form-floating">
                <input data-position="midle" type="text" class="form-control @error('username') is-invalid @enderror"
                    id="username" name="username" placeholder="Username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input data-position="midle" type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" placeholder="Email">
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input data-position="midle" type="password"
                    class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                    placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="form-floating">
                <input data-position="midle" type="text" class="form-control @error('no_hp') is-invalid @enderror"
                    id="no_hp" name="no_hp" placeholder="Telepon">
                <label for="no_hp">Telepon</label>
            </div>
            <div class="form-floating">
                <input data-position="last" type="text" class="form-control @error('alamat') is-invalid @enderror"
                    id="alamat" name="alamat" placeholder="Alamat">
                <label for="alamat">Alamat</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Registrasi</button>
            <p>Sudah menjadi anggota? <a href="/login">Login</a></p>
            <p class="mt-5 text-body-secondary">&copy; 2024 All rights reserved.</p>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
