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
            Master Universitas
        </h4>
    </div>
    <div class="col-md-2 col-12 mb-3 ps-5 d-flex justify-content-between">
    </div>
    <div class="col-md-2 col-12 text-end">
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-master-universitas">Add Universitas</button>
    </div>
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-universitas">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th >Nama universitas</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Status</th>
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
<div class="modal fade" id="modal-master-universitas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Universitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" enctype="multipart/form-data" action="{{ route('univ.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="namauniv" class="form-label">Nama Universitas</label>
                            <input type="text" id="namauniv" name="namauniv" class="form-control" placeholder="Masukkan Universitas" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col mb-2 form-input">
                        <label for="kategori" class="form-label">Universitas</label>
                        <select class="form-select select2" id="kategori" name="kategori"
                            data-placeholder="Pilih Kategori">
                            <option disabled selected>Pilih Kategori</option>
                                <option value="1">SMA/SMK</option>
                                <option value="2">Perguruan Tinggi</option>
                        </select>
                        <div class="invalid-feedback"></div>
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
                <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin menonaktifkan universitas</h5>
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

    var table = $('#table-master-universitas').DataTable({
        // "data": jsonData,
        ajax: '{{ route("univ.show")}}',
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
                data: "namauniv",
                name: "namauniv"
            },
            {
                data: "kategori",
                name: "kategori"
            },
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
        let action = `{{ url('super-admin/master-universitas/update') }}/${id}`;
        var url = `{{ url('super-admin/master-universitas/edit') }}/${id}`;

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Aktifitas");
                $("#modal-button").html("Update Data");
                $('#modal-master-universitas form').attr('action', action);
                $('#namauniv').val(response.namauniv);
                $('#kategori').val(response.kategori);
                $('#modal-master-universitas').modal('show');
            }
        });
    }

    $("#modal-master-universitas").on("hide.bs.modal", function() {
    $("#modal-title").html("Tambah Akifitas");
    $("#modal-button").html("Simpan")
    $('#modal-master-universitas form')[0].reset();
    $('#modal-master-universitas form #role').val('').trigger('change');
    $('#modal-master-universitas form').attr('action', "{{ url('super-admin/master-universitas/store') }}");
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
