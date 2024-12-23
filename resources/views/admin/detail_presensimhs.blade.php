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
        <button class="btn btn-outline-success my-2 waves-effect p-3 mb-4" type="button" id="back" style="width: 15%; height:12%;">
            <i class="bi bi-arrow-left text-success" style="font-size: medium;"> Kembali </i>
        </button>
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs"></span>
        Detail Presensi {{ $mahasiswa->namamhs ?? '' }}
        </h4>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-detail-presensimhs">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Date</th>
                                    <th>Chekin</th>
                                    <th>Chekout</th>
                                    <th>nim</th>
                                    <th>Status</th>
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

    var nim = '{{ $mahasiswa->nim }}'; // Ambil nim dari view

    var table = $('#table-detail-presensimhs').DataTable({
        ajax: `/super-admin/presensi/detail/${nim}`, // Endpoint dengan nim dinamis
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "DT_RowIndex"
            },
            {
                data: "tgl",
                name: "tgl"
            },
            {
                data: "jammasuk",
                name: "jammasuk"
            },
            {
                data: "jamkeluar",
                name: "jamkeluar"
            },
            {
                data: "mahasiswa.nim",
                name: "nim"
            },
            {
                data: "status",
                name: "status"
            },
        ]
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
