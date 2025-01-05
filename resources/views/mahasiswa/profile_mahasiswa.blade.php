@extends('mahasiswa.template')

@section('page_style')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('main')
<!-- Content wrapper -->
<div class="content-wrapper">
    
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills flex-column flex-md-row mb-4">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);"
                ><i class="ti-xs ti ti-users me-1"></i> Account</a
              >
            </li>
          </ul>
          <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->
            <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                src="../../assets/img/avatars/14.png"
                alt="user-avatar"
                class="d-block w-px-100 h-px-100 rounded"
                id="uploadedAvatar"
                />
                <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="ti ti-upload d-block d-sm-none"></i>
                    <input
                    type="file"
                    id="upload"
                    class="account-file-input"
                    hidden
                    accept="image/png, image/jpeg"
                    />
                </label>
                <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                    <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                </button>

                <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div>
            </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$mahasiswa->namamhs}}" disabled autofocus/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <input class="form-control" type="text" name="nim" id="nim" value="{{$mahasiswa->nim}}" disabled/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="" value="{{$mahasiswa->emailmhs}}" disabled/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="univ" class="form-label">University Origin</label>
                    <input type="text" class="form-control" id="univ"  name="univ" disabled value="{{$mahasiswa->univ->namauniv}}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="prodi" class="form-label">Study Program</label>
                    <input type="text" class="form-control" id="prodi" name="prodi" disabled value="{{$mahasiswa->jurusan?->jurusan ?? ''}}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="division" class="form-label">Division</label>
                    <input type="text" class="form-control" id="division" disabled name="division" placeholder="content creator" value="{{$mahasiswa?->posisi?? ''}}">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="religion" class="form-label">Religion</label>
                    <input type="text" class="form-control" id="religion" name="religion" disabled placeholder="islam"  value="{{$mahasiswa?->agama ?? ''}}"  />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="place" class="form-label">Place of birth</label>
                    <input type="text" class="form-control" id="place"  name="place" disabled placeholder="jakarta" value="{{$mahasiswa?->tempatlahirmhs?? ''}}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="birth" class="form-label">date of birth</label>
                    <input type="text" class="form-control" id="birth" name="birth" disabled placeholder="dd/mm/yy" value="{{$mahasiswa?->tanggallahirmhs??''}}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                    <div class="input-group input-group-merge">
                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" disabled placeholder="0802 555 0111" value="{{$mahasiswa?->nohpmhs ?? ''}}">
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" disabled placeholder="Address" value="{{$mahasiswa?->alamatmhs?? ''}}">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender" disabled placeholder="gender" value="{{$mahasiswa?->jeniskelamin?? ''}}" />
                </div>
                </div>
                <div class="mt-2">
                <button type="button" class="btn btn-success m-0" data-id="{{$mahasiswa->nim}}" data-bs-toggle="modal" onclick="edit($(this))" data-bs-target="#modal-profile-mhs">Edit Profile</button>
                </div>
            </div>
            <!-- /Account -->
        </div>
    </div>
    @include('mahasiswa.modal.modal_profile')
@endsection
@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>
    function edit(e) {
        let id = e.attr('data-id');
        let action = `{{ url('mahasiswa/profile/update/') }}/${id}`;
        var url = `{{ url('mahasiswa/profile/edit') }}/${id}`;
        console.log(url);
        
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            success: function(response) {
                $("#modal-button").html("Update Data");
                $('#modal-profile-mhs form').attr('action', action);
                $('#posisi').val(response.posisi);
                $('#tempatlahirmhs').val(response.tempatlahirmhs);
                $('#tanggallahirmhs').val(response.tanggallahirmhs);
                $('#nohpmhs').val(response.nohpmhs);
                $('#alamatmhs').val(response.alamatmhs);
                $('#jeniskelamin').val(response.jeniskelamin);
            }
        });
    }
    jQuery(function() {
        jQuery('.showSingle').click(function() {
            jQuery('.targetDiv').hide('.cnt');
            jQuery('#div' + $(this).attr('target')).slideToggle();
        });
    });
    
</script>
<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection
