@extends('mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="{{url('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<style>
    .tooltip-inner {
        max-width: 210px;
        /* If max-width does not work, try using width instead */
        width: 900px;
    }
    /* Tambahkan di file CSS Anda */
  .big-time {
      font-size: 10rem;
      font-weight: bolder;
  }

</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-8 col-12">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs"></span>
            Presensi
        </h4>
        
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-warning alert-dismissible" role="alert">
                Lakukan Chek-in dan Chek-out pada jam 09.00 dan 17.00 WIB 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @if($isDisabled)
            <div class="alert alert-warning mt-2">
                Anda belum memilih supervisor. Silahkan pilih supervisor pada menu profil Anda.
            </div>
            @endif
          <div class="card">
            <div class="card-body text-center">
              <h1 class="mb-1 card-title attendance-timer text-primary m-0" id="work-time"></h1>
              <div class="d-flex align-items-center justify-content-around my-3 py-1">
                  <div>
                      <h4 class="mb-0">09.00</h4>
                      <span>Check-in</span>
                  </div>
                  <div>
                      <h4 class="mb-0">18.00</h4>
                      <span>Check-out</span>
                  </div>
                  <div>
                      <!-- Tanggal saat ini -->
                      <h4 class="mb-0" id="current-date"></h4>
                      <span>Tanggal</span>
                  </div>
              </div>
              <form class="default-form" method="POST" action="{{ route('presensi.store') }}">
                @csrf
                <div class="d-flex align-items-center justify-content-center">
                    @php
                         use Carbon\Carbon;
                        $today = Carbon::now('Asia/Jakarta')->toDateString();
                        $now = Carbon::now('Asia/Jakarta');
                        $batasCheckIn = Carbon::createFromTime(12, 0, 0, 'Asia/Jakarta'); // Batas jam check-in
                        $presensiHariIni = \App\Models\Presensi::where('nim', auth()->user()->nim)
                            ->whereDate('tgl', $today)
                            ->whereNotNull('jamkeluar')
                            ->first();
                        $presensi = \App\Models\Presensi::where('nim', auth()->user()->nim)
                            ->whereDate('tgl', $today)
                            ->whereNull('jamkeluar')
                            ->first();
                        $disableCheckIn = $now->greaterThan($batasCheckIn) && !$presensi; // Jika waktu sekarang lebih dari batas dan belum check-in
                    @endphp


                    @if ($presensiHariIni)
                        <!-- Tombol sudah disable jika check-in dan check-out sudah dilakukan hari ini -->
                        <button type="button" class="btn btn-secondary d-flex align-items-center me-3 waves-effect waves-light" disabled>
                            <span class="ti-xs me-1 ti ti-user-check me-1"></span>Sudah Check-in & Check-out Hari Ini
                        </button>
                    @elseif ($presensi)
                        <!-- Tombol Check-out -->
                        <button type="submit" id="modal-button" class="btn btn-danger d-flex align-items-center me-3 waves-effect waves-light">
                            <span class="ti-xs me-1 ti ti-user-x me-1"></span>Check-out
                        </button>
                    @else
                        <!-- Tombol Check-in -->
                        <button type="submit" id="modal-button" class="btn btn-primary d-flex align-items-center me-3 waves-effect waves-light" 
                            @if($disableCheckIn || $isDisabled) disabled @endif>
                            <span class="ti-xs me-1 ti ti-user-check me-1"></span>
                            @if($disableCheckIn) Check-in Ditutup @else Check-in @endif
                        </button>
                    @endif
                    
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-8 col-12 g-4">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs"></span>
        Daftar Presensi
        </h4>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-presensi-mahasiswa">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Tanggal</th>
                                    <th style="min-width: 125px;">Checkin</th>
                                    <th>Checkout</th>
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
    //
    var table = $('#table-presensi-mahasiswa').DataTable({
        ajax: '{{ url("mahasiswa/presensi/show/{id}")}}',
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

  function updateClock() {
      const now = new Date();
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      const currentTime = `${hours}:${minutes}:${seconds}`;
      document.getElementById('work-time').textContent = currentTime;
  }

  function updateDate() {
      const now = new Date();
      const day = String(now.getDate()).padStart(2, '0');
      const month = String(now.getMonth() + 1).padStart(2, '0');
      const year = now.getFullYear();
      const currentDate = `${day}-${month}-${year}`;
      document.getElementById('current-date').textContent = currentDate;
  }
  setInterval(updateClock, 1000);
  updateDate();
  </script>

<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection