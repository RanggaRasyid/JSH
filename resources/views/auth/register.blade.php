@extends('auth_template.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class=""   style="margin-left: 80px">
                    <h3 class="mb-1 fw-bold">Welcome to Magang <span><a href="{{ url('/') }}"><img src={{ asset('background/logo-jsh.png') }} alt="icon" style="margin-bottom: 10px;" width="auto" height="50px"></a></span>👋</h3>
                    <p class="mb-4">Please Register to your account and start the adventure</p>

                    <div class="form-group mb-3">
                        <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>
                        <div class="form-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email') 
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="col-md-4 col-form-label">{{ __('Nama') }}</label>
                        <div class="form-group mb-3">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                            @error('name') 
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nim" class="col-md-4 col-form-label">{{ __('NIM') }}</label>
                        <div class="form-group mb-3">
                            <input id="nim" type="nim" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" autocomplete="nim" autofocus>
                            @error('nim') 
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                        <div class="form-group mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password" autofocus>
                            @error('password') 
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label ">{{ __('Confirm Password') }}</label>
                        <div class="form-group mb-3">                            
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                          
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    <p class="text-center">
                        <span>Already have an account? <a href="{{ route('login') }}">Login</a></span>

                        <a href="{{ route('login') }}">
                          <span> Sign in instead</span>
                        </a>
                    </p>
                    </div>

                </div>
            </form>
      
        </div>
    </div>
@endsection

