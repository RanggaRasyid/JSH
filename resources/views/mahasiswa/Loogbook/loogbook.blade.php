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
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Tabs -->
            <div class="nav-align-top">
                <ul class="nav nav-pills mb-3" role="tablist">
                    @foreach (['total', 'pending', 'diterima', 'ditolak'] as $key => $type)
                        <li class="nav-item" style="font-size: small;">
                            <button type="button" 
                                class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                data-bs-toggle="tab" 
                                data-bs-target="#navs-pills-justified-{{ $type }}"
                                role="tab"
                                aria-controls="navs-pills-justified-{{ $type }}" 
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                style="padding: 8px 9px;">
                                @if ($type === 'total')
                                    <i class="tf-icons ti ti-briefcase ti-xs me-1"></i>
                                @elseif ($type === 'pending')
                                    <i class="tf-icons ti ti-clock ti-xs me-1"></i>
                                @elseif ($type === 'diterima')
                                    <i class="tf-icons ti ti-clipboard-check ti-xs me-1"></i>
                                @elseif ($type === 'ditolak')
                                    <i class="tf-icons ti ti-clipboard-x ti-xs me-1"></i>
                                @endif
                                {{ ucfirst($type) }} ({{ $loogbook[$type] }})
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>            
    
            <!-- Button Add Activity -->
            <button class="btn btn-success waves-effect waves-light" 
                data-bs-toggle="modal" 
                data-bs-target="#modal-loogbook"
                @if($isDisabled) disabled @endif>
                Add Activity
            </button>
        </div>
    
        <!-- Pesan jika tombol dinonaktifkan -->
        @if($isDisabled)
            <div class="alert alert-warning mt-2">
                Anda belum memilih supervisor. Silahkan pilih supervisor pada menu profil Anda.
            </div>
        @endif
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


@include('mahasiswa.loogbook.modal')
@endsection

@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>

    $('.table').each(function() {
        let idElement = $(this).attr('id'); // Mengambil ID dari tabel
        let url = "{{ url('mahasiswa/loogbook/show/')}}?type=" + idElement;
                
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

    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        let targetId = $(e.target).data('bs-target').replace('#navs-pills-justified-', '');
        $(`#${targetId}`).DataTable().ajax.reload(null, false);
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
</script>

<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection
