<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login/register</title>
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
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
        .h-custom {
        height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
        .h-custom {
        height: 100%;
        }
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
<section class="vh-100">
    {{-- <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <div class="container">
                    <div class="row justify-content-center">
            
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
            
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div style="margin-left: 80px">
                                <h3 class="mb-1 fw-bold">Selamat Datang di Magang
                                    <span>
                                        <a href="{{ url('/') }}">
                                            <img src="{{ asset('background/logo-jsh.png') }}" alt="icon" style="margin-bottom: 10px;" width="auto" height="50px">
                                        </a>
                                    </span>
                                    👋
                                </h3>
                                <p class="mb-4">Silahkan daftarkan akun Anda dan mulai petualangan.</p>
            
                                <div class="form-group mb-3">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
            
                                <div class="form-group mb-3">
                                    <label for="name">{{ __('Nama') }}</label>
                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
            
                                <div class="form-group mb-3">
                                    <label for="nim">{{ __('NIM/NISN') }}</label>
                                    <input id="nim" type="nim" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" autocomplete="nim" autofocus>
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
            
                                <div class="row mb-3">
                                    <div class="col mb-2 form-input">
                                        <label for="univ" class="form-label">Asal Kampus/Asal Sekolah</label>
                                        <select class="form-select select2" id="pilihuniversitas_add" name="univ"
                                            data-placeholder="Pilih Kategori">
                                            <option disabled selected>Pilih Kampus/Sekolah</option>
                                            @foreach ($univ as $u)
                                                <option value="{{ $u->id_univ }}">{{ $u->namauniv }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
            
                                <div class="row mb-3">
                                    <div class="col mb-2 form-input">
                                        <label for="jurusan" class="form-label">Jurusan</label>
                                        <select class="form-select select2" id="pilih-jurusan" name="jurusan"
                                            data-placeholder="Pilih Jurusan">
                                            <option disabled selected>Pilih Jurusan</option>
                                            @foreach ($jurusan as $j)
                                                <option value="{{ $j->id_jurusan }}">{{ $j->jurusan }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
            
                                <div class="form-group mb-3">
                                    <label for="password">{{ __('Kata Sandi') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
            
                                <div class="form-group mb-3">
                                    <label for="password-confirm">{{ __('Konfirmasi Kata Sandi') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
            
                                <button type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);">
                                    {{ __('Daftar') }}
                                </button>
            
                                <p class="text-center mt-3">
                                    <span>Sudah memiliki akun? <a href="{{ route('login') }}">Masuk</a></span>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="form-group mb-3">
                <a href="/auth/redirect" class="btn btn-outline-success d-grid w-100">
                    Masuk dengan Google
                </a>
            </div>
        </div>
    </div>
</section>
</body>
</html>