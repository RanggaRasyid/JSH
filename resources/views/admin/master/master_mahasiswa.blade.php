@extends('mahasiswa.template')

@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
<link rel="stylesheet" href="{{url('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<style>
    .tooltip-inner {
        max-width: 210px;
        /* If max-width does not work, try using width instead */
        width: 900px;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-8 col-12">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs"></span>
            Master Mahasiswa
        </h4>
    </div>
    <div class="col-md-2 col-12 mb-3 ps-5 d-flex justify-content-between">
    </div>
    <div class="col-md-2 col-12 text-end">
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-master-mahasiswa">Add Mahasiswa</button>
    </div>
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-mahasiswa">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width: 125px;">Nama Mahasiswa</th>
                                <th>Email</th>
                                <th>NIM/NISN</th>
                                <th>Instansi</th>
                                <th>Jurusan</th>
                                <th>Status</th>
                                <th style="min-width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal edit --}}
<div class="modal fade" id="modal-master-mahasiswa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" enctype="multipart/form-data" action="{{ route('master.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="namamhs" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" name="namamhs" class="form-control" placeholder="Masukkan Nama" />
                            <div class="invalid-feedback"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" id="nim" onkeyup="this.value = this.value.replace(/[^0-9]+/g, '');" name="nim" class="form-control" placeholder="Masukkan NIM" />
                            <div class="invalid-feedback"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="emailmhs" name="emailmhs" class="form-control" placeholder="Masukkan Email" />
                            <div class="invalid-feedback"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label">Universitas/Sekolah</label>
                            <select class="form-select select2" id="instansi" name="univ"
                                data-placeholder="Pilih Universitas">
                                <option disabled selected>Pilih Universitas/Sekolah</option>
                                @foreach ($univ as $u)
                                    <option value="{{ $u->id_univ }}">{{ $u->namauniv }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label">Jurusan</label>
                            <select class="form-select select2" id="jurusan" name="jurusan"
                                data-placeholder="Pilih Jurusan">
                                <option disabled selected>Pilih Jurusan</option>
                                @foreach ($jurusan as $u)
                                    <option value="{{ $u->id_jurusan }}">{{ $u->jurusan }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                minlength="8"
                                onkeyup="validatePassword()"
                            />
                            <div class="invalid-feedback">
                                Password harus minimal 8 karakter.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal Alert --}}
<div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../../app-assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin menonaktifkan Mahasiswa</h5>
                <div class="swal2-html-container" id="swal2-html-container" style="display: block;">
                    Data yang dipilih akan non-aktif</div>
            </div>
            <div class="modal-footer" style="display: flex; justify-content:center;">
                <button type="submit" id="modal-button" class="btn btn-success">Ya, Yakin</button>
                <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>

    var table = $('#table-master-mahasiswa').DataTable({
        ajax: '{{ route("master.show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [
            {
                data: 'DT_RowIndex'
            },
            {
                data: "namamhs",
                name: "namamhs"
            },
            {
                data: "emailmhs",
                name: "emailmhs"
            },
            {
                data: "nim",
                name: "nim"
            },
            {
                data: 'univ.namauniv',
                name: 'namauniv' },

            {
                data: 'jurusan.jurusan',
                name: 'jurusan' },
            {
                data: "status",
                name: "status"
            },
            {
                data: 'action',
                name: 'action'
            }

        ]
    });

    function edit(e) {
        let id = e.attr('data-id');
        let action = `{{ url('super-admin/master-mahasiswa/update') }}/${id}`;
        var url = `{{ url('super-admin/master-mahasiswa/edit') }}/${id}`;

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Aktifitas");
                $("#modal-button").html("Update Data");
                $('#modal-master-mahasiswa form').attr('action', action);
                $('#namamhs').val(response.namamhs).trigger('change');
                $('#nim').val(response.nim);
                $('#nim').prop('disabled', true);
                $('#emailmhs').val(response.emailmhs);
                $('#jurusan').val(response.id_jurusan);
                $('#instansi').val(response.id_univ);
                $('#password').val(response.password);
                $('#modal-master-mahasiswa').modal('show');
            }
        });
    }

    $("#modal-master-mahasiswa").on("hide.bs.modal", function() {
    $("#modal-title").html("Tambah Akifitas");
    $("#modal-button").html("Simpan")
    $('#modal-master-mahasiswa form')[0].reset();
    $('#nim').val('').prop('disabled', false); // Aktifkan saat tambah data
    $('#modal-master-mahasiswa form #role').val('').trigger('change');
    $('#modal-master-mahasiswa form').attr('action', "{{ url('super-admin/master-mahasiswa/store') }}");
    $('.invalid-feedback').removeClass('d-block');
    $('.form-control').removeClass('is-invalid');
    });

    jQuery(function() {
        jQuery('.showSingle').click(function() {
            jQuery('.targetDiv').hide('.cnt');
            jQuery('#div' + $(this).attr('target')).slideToggle();
        });
    });

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
