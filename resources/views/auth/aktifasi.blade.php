@extends('auth_template.auth')
@section('content')
    <div class="container text-center mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>Account Non-Active</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">
                            <h4>
                                Silahkan hubungi Administrator JSH untuk melakukan aktivasi akun Anda.
                            </h4>
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <h5>
                               Login
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
