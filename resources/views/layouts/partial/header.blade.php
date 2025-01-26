<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing-Page</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('background/logo-jsh.png')}}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }

        .carousel-inner img {
            object-fit: cover;
            /* Menyesuaikan gambar agar tidak terdistorsi */
            max-height: 780px;
            /* Anda bisa menyesuaikan ini sesuai kebutuhan */
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <nav class="navbar navbar-expand-lg" style="background-color: #b1d6c4;">
        <div class="container-fluid">
            <div class="nav-item">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('background/logo-jsh.png') }}" style="width: 100px; max-width: 100px;">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @php
            $user = Auth::user();
            @endphp
            @if (!$user)
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}">
                            <button type="button" class="btn btn-success m-2">Masuk</button>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('register') }}">
                            <button type="button" class="btn btn-success m-2">Daftar</button>
                        </a>
                    </li> --}}
                </ul>
            </div>
            @endif
        </div>
    </nav>
</body>

</html>
