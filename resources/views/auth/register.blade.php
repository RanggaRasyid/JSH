@extends('auth_template.auth')

@section('content')
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
                    <h3 class="mb-1 fw-bold">Welcome to Magang
                        <span>
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('background/logo-jsh.png') }}" alt="icon" style="margin-bottom: 10px;" width="auto" height="50px">
                            </a>
                        </span>
                        👋
                    </h3>
                    <p class="mb-4">Please Register to your account and start the adventure</p>

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
                        <label for="nim">{{ __('NIM') }}</label>
                        <input id="nim" type="nim" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" autocomplete="nim" autofocus>
                        @error('nim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label">Kategori</label>
                            <select class="form-select select2" id="pilihuniversitas_add" name="univ"
                                data-placeholder="Pilih Kategori">
                                <option disabled selected>Pilih Kategori</option>
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
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);">
                        {{ __('Register') }}
                    </button>

                    <p class="text-center mt-3">
                        <span>Already have an account? <a href="{{ route('login') }}">Login</a></span>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
