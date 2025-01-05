@extends('mahasiswa.template')

@section('page_style')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            Loogbook
        </h4>
    </div>
    <div class="col-md-2 col-12 mb-3 ps-5 d-flex justify-content-between">
    </div>
    <div class="col-md-2 col-12 text-end">
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-loogbook">Add Activity</button>
    </div>
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-loogbook-mahasiswa">
                        <thead>
                            <tr>
                                <th style="max-width:30px">NO</th>
                                <th style="min-width: 125px;">Title</th>
                                <th>Deskription</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Gambar</th>
                                <th>AKSI</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('mahasiswa.loogbook.modal')
@endsection

@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>

    var table = $('#table-loogbook-mahasiswa').DataTable({
        ajax: '{{ url("mahasiswa/loogbook/show/{id}")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "DT_RowIndex"
            },
            {
                data: "nama",
                name: "nama"
            },
            {
                data: "deskripsi",
                name: "deskripsi"
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "updated_at",
                name: "updated_at",
            },
            {
                data: "picture",
                name: "picture",
            },
            {
                data: "action",
                name: "action"
            },
            {
                data: "status",
                name: "status"
            }
        ]

    });

    function edit(e) {
        let id = e.attr('data-id');
        let action = `{{ url('mahasiswa/loogbook/update') }}/${id}`;
        var url = `{{ url('mahasiswa/loogbook/edit') }}/${id}`;

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                
                $("#modal-title").html("Edit Aktifitas");
                $("#modal-button").html("Update Data");
                $('#modal-loogbook form').attr('action', action);
                $('#nama').val(response.nama);
                $('#deskripsi').val(response.deskripsi);
                $('#modal-loogbook').modal('show');
            }
        });
    }

    $("#modal-loogbook").on("hide.bs.modal", function() {
        $("#modal-title").html("Tambah Akifitas");
        $("#modal-button").html("Simpan")
        $('#modal-loogbook form')[0].reset();
        $('#modal-loogbook form #role').val('').trigger('change');
        $('#modal-loogbook form').attr('action', "{{ url('mahasiswa/loogbook/store') }}");
        $('.invalid-feedback').removeClass('d-block');
        $('.form-control').removeClass('is-invalid');
    });

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
