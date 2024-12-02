@extends('auth_template.auth')
@section('content')
    <div class="container text-center mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>Registrasi Berhasil</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">
                            <strong>Register Berhasil!</strong> <br>
                            Silahkan hubungi Administrator JSH untuk melakukan aktifasi akun Anda.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            Kembali ke Halaman Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
