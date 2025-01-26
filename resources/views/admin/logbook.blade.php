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
    <!-- Tabs -->
    <div class="nav-align-top">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link active showSingle" target="1" role="tab"
                    data-bs-toggle="tab" data-bs-target="#navs-pills-justified-total"
                    aria-controls="navs-pills-justified-total" aria-selected="true" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-briefcase ti-xs me-1"></i>
                    Total 
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="2" role="tab"
                    data-bs-toggle="tab" data-bs-target="#navs-pills-justified-pending"
                    aria-controls="navs-pills-justified-pending" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-clock ti-xs me-1"></i>
                    Pending 
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="3" role="tab"
                    data-bs-toggle="tab" data-bs-target="#navs-pills-justified-diterima"
                    aria-controls="navs-pills-justified-diterima" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-clipboard-check ti-xs me-1"></i>
                    Diterima 
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="4" role="tab"
                    data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak"
                    aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-clipboard-x ti-xs me-1"></i>
                    Ditolak 
                </button>
            </li>
        </ul>
    </div> 
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="tab-content mt-4">
            @foreach (['total', 'pending', 'diterima', 'ditolak'] as $key => $type)
                <div 
                    class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                    id="navs-pills-justified-{{ $type }}" 
                    role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table tab1c" id="{{ $type }}">
                            <thead>
                                <tr>
                                    <th style="max-width: 30px;">NO</th>
                                    <th style="min-width: 125px;">Judul Aktivitas</th>
                                    <th>Deskripsi</th>
                                    <th>Pencipta</th>
                                    <th>Dibuat</th>
                                    <th>Diperbarui</th>
                                    <th>Gambar</th>
                                    <th>AKSI</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@include('admin.modal.modal-konfirmasi')
@endsection
@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>
    $('.table').each(function() {
        let idElement = $(this).attr('id'); 
        let url = "{{ url('super-admin/logbook/show/')}}?type=" + idElement;
                
        $(this).DataTable({
            ajax: url,
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: 
            [{
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
                data: "nimmhs.namamhs",
                name: "nimmhs.namamhs"
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
            }],
        });
    });

    // var table = $('#table-loogbook-admin').DataTable({
    //     ajax: '{{ url("super-admin/logbook/show/{id}")}}',
    //     serverSide: false,
    //     processing: true,
    //     deferRender: true,
    //     type: 'GET',
    //     destroy: true,
    //     columns: [{
    //             data: "DT_RowIndex"
    //         },
    //         {
    //             data: "nama",
    //             name: "nama"
    //         },
    //         {
    //             data: "deskripsi",
    //             name: "deskripsi"
    //         },
    //         {
    //             data: "created_at",
    //             name: "created_at",
    //         },
    //         {
    //             data: "picture",
    //             name: "picture",
    //         },
    //         {
    //             data: "action",
    //             name: "action"
    //         },
    //         {
    //             data: "status",
    //             name: "status"
    //         }
    //     ]

    // });

    $(document).ready(function () {
        // Fungsi Approve
        $(document).ready(function () {
            $(document).on('click', '.btn-approve', function () {
                const id = $(this).data('id');
                const url = $(this).data('url').replace(':id', id);
                const status = $(this).data('status'); 
                console.log(id);
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "The selected logbook will be approved",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, approve it!",
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger",
                    },
                    buttonsStyling: false,
                }).then(function (result) {
                    if (result.isConfirmed) {
                        // Kirim request AJAX
                        $.ajax({
                            method: "POST",
                            url: '/super-admin/logbook/approve/' + id,
                            data: { status: status }, // Kirim status sebagai parameter
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            
                            success: function (response) {
                                if (response.error) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.message,
                                        customClass: { confirmButton: "btn btn-danger" },
                                        buttonsStyling: false,
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Succeed!",
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                                    const types = ['total', 'pending', 'diterima', 'ditolak'];
                                    types.forEach(type => {
                                        const tableId = `#${type}`; // Buat ID tabel dinamis
                                        if ($.fn.DataTable.isDataTable(tableId)) {
                                            $(tableId).DataTable().ajax.reload(null, false); // Reload tanpa mengubah posisi paging
                                        }
                                    });
                                }
                            },
                            error: function (xhr) {
                                console.error("Error:", xhr.responseText);
                                Swal.fire({
                                    icon: "error",
                                    title: "Error!",
                                    text: "Failed to approve. Please try again.",
                                    customClass: { confirmButton: "btn btn-danger" },
                                    buttonsStyling: false,
                                });
                            },
                        });
                    }
                });
            });
        });
        $(document).ready(function () {
            $(document).on('click', '.btn-reject', function () {
                const id = $(this).data('id');
                const url = $(this).data('url').replace(':id', id);
                const status = $(this).data('status'); 
                console.log(id);
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "The selected logbook will be approved",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, approve it!",
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger",
                    },
                    buttonsStyling: false,
                }).then(function (result) {
                    if (result.isConfirmed) {
                        // Kirim request AJAX
                        $.ajax({
                            method: "POST",
                            url: '/super-admin/logbook/tolak/' + id,
                            data: { status: status }, // Kirim status sebagai parameter
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            
                            success: function (response) {
                                if (response.error) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response.message,
                                        customClass: { confirmButton: "btn btn-danger" },
                                        buttonsStyling: false,
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Succeed!",
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                                    const types = ['total', 'pending', 'diterima', 'ditolak'];
                                    // Reload DataTable setelah berhasil
                                    types.forEach(type => {
                                        const tableId = `#${type}`; // Buat ID tabel dinamis
                                        if ($.fn.DataTable.isDataTable(tableId)) {
                                            $(tableId).DataTable().ajax.reload(null, false); // Reload tanpa mengubah posisi paging
                                        }
                                    });
                                }
                            },
                            error: function (xhr) {
                                console.error("Error:", xhr.responseText);
                                Swal.fire({
                                    icon: "error",
                                    title: "Error!",
                                    text: "Failed to approve. Please try again.",
                                    customClass: { confirmButton: "btn btn-danger" },
                                    buttonsStyling: false,
                                });
                            },
                        });
                    }
                });
            });
        });
        
    });

    // Fungsi Rejected



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
