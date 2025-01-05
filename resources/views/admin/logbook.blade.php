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
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-loogbook-admin">
                        <thead>
                            <tr>
                                <th >NO</th>
                                <th >Title</th>
                                <th>Deskription</th>
                                <th>Created-At</th>
                                <th>Gambar</th>
                                <th>AKSI</th>
                                <th>status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modal.modal-konfirmasi')
@endsection
@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>

    var table = $('#table-loogbook-admin').DataTable({
        ajax: '{{ url("super-admin/logbook/show/{id}")}}',
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

    $(document).ready(function () {
    // Fungsi Approve
    $(document).on('click', '.btn-approve', function () {
        const id = $(this).data('id');
        const approveUrl = '{{ url('super-admin/loogbook/status') }}/' + id;

        $('#modalapprove').modal('show');

        $('#approve-confirm-button')
            .off('click')
            .on('click', function () {
                $.ajax({
                    url: approveUrl,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        alert(response.error ? response.message : 'Berhasil melakukan approve!');
                        $('#modalapprove').modal('hide');
                        if (response.table) {
                            $(response.table).DataTable().ajax.reload();
                        }
                    },
                    error: function (xhr) {
                        alert('Gagal melakukan approve. Silakan coba lagi.');
                        console.error(xhr.responseText);
                    },
                });
            });
    });

    // Fungsi Rejected
    $(document).on('click', '.btn-reject', function () {
        const id = $(this).data('id');
        const rejectedUrl = '{{ url('super-admin/loogbook/tolak') }}/' + id;

        $('#modalreject').modal('show');

        $('#rejected-confirm-button')
            .off('click')
            .on('click', function () {
                const alasan = $('#alasan').val();

                if (!alasan.trim()) {
                    alert('Alasan penolakan wajib diisi.');
                    return;
                }

                $.ajax({
                    url: rejectedUrl,
                    type: 'POST',
                    data: {
                        alasan: alasan,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        alert(response.error ? response.message : 'Berhasil melakukan penolakan!');
                        $('#modalreject').modal('hide');
                        if (response.table) {
                            $(response.table).DataTable().ajax.reload();
                        }
                    },
                    error: function (xhr) {
                        alert('Gagal melakukan penolakan. Silakan coba lagi.');
                        console.error(xhr.responseText);
                    },
                });
            });
        });
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
