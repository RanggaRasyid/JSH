@extends('mahasiswa.template')

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
    <div class="col-md-8 col-12 g-4">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs"></span>
        Daftar Presensi Mahasiswa
        </h4>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-master-presensi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="min-width: 125px;">Nama</th>
                                    <th>Universitas</th>
                                    {{-- <th>Total Presensi</th> --}}
                                    <th>Jurusan</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>

    var table = $('#table-master-presensi').DataTable({
        ajax: '{{ url("super-admin/presensi/show/{id}")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "DT_RowIndex"
            },
            {
                data: "namamhs",
                name: "namamhs"
            },
            {
                data: "univ.namauniv",
                name: "namauniv"
            },
            {
                data: "jurusan.jurusan",
                name: "jurusan"
            },
            {
                data: "detail",
                name: "detail"
            },
        ]
    });

    function edit(e) {
        let id = e.attr('data-id');

        let action = `{{ url('sesuaikan') }}/${id}`;
        var url = `{{ url('sesuaikan') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modalTambahMitraTitle").html("Edit Pengguna");
                $("#modal-button").html("Update Data")
                $('#modalTambahMitra form').attr('action', action);
                $('#nama').val(response.nama);
                $('#nohp').val(response.nohp);
                $('#email').val(response.email);
                $('#role').val(response.role).trigger('change');

                $('#modal-thn-akademik').modal('show');
            }
        });
    }

    $("#modalTambahMitra").on("hide.bs.modal", function() {

        $("#modalTambahMitraTitle").html("Tambah Pengguna");
        $("#modal-button").html("Simpan")
        $('#modalTambahMitra form')[0].reset();
        $('#modalTambahMitra form #role').val('').trigger('change');
        $('#modalTambahMitra form').attr('action', "{{ url('sesuaikan') }}");
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
