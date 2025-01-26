@extends('layouts.auth')
@section('page_style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{url('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection
@section('content')
<!-- Content -->
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-4 mt-2">
            <a href="" class="app-brand-link gap-2">
              <span class="app-brand-text demo text-body fw-bold ms-1">JSH Intern</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1 pt-2">Lengkapi Data</h4>
          <p class="mb-4">Make your app management easy and fun!</p>

          <form enctype="multipart/form-data" class="default-form mb-3" action="{{ url('mahasiswa/register') }}" method="POST">
            @csrf
            <div class="modal-body">
            <div class="mb-3 form-input">    
                <label for="nim" class="form-label">nim</label>
                <input type="text"class="form-control" placeholder="6706" id="nim" name="nim" onkeyup="this.value = this.value.replace(/[^0-9]+/g, '');"/>
                <div class="invalid-feedback"></div>   
              </div>
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
            <div class="mb-3 form-password-toggle form-input">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password"
                  onkeyup="validatePassword()"
                />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
              <div class="invalid-feedback">
                Password harus minimal 8 karakter.
              </div>
            </div>

              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                  </label>
                </div>
              </div>
              <button type="submit" id="modal-button" class="btn btn-success d-grid w-100">Lanjutkan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
<!-- / Content -->
@endsection
@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>
function validatePassword() {
  const passwordInput = document.getElementById('password');
  const feedback = passwordInput.nextElementSibling;

  if (passwordInput.value.length >= 8) {
      passwordInput.classList.remove('is-invalid');
      feedback.style.display = 'none';
  } else {
      passwordInput.classList.add('is-invalid');
      feedback.style.display = 'block';
  }
}
</script>
<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection