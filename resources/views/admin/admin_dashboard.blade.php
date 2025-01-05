@extends('mahasiswa.template')
@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('main')
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner mt-1">
            <div class="carousel-item active">
                <img src="{{ asset('background/faktanya.jpeg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('background/Berbisa.jpeg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('background/Peta USHD.jpeg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Statistics -->
<div class="col-12 mt-4">
    <div class="card h-100">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        
                        <div class="card-info">
                            <h5 class="mb-0">100</h5>
                            <p class="mb-0" style="font-size:18px;">Mahasiswa Magang</p>
                            {{-- <a href="#" class="mb-0 text-primary" style="font-size:18px;">Detail</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-warning me-3 p-2">
                            <i class="ti ti-clock ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">100</h5>
                            <p class="mb-0" style="font-size:18px;">Siswa Magang</p>
                            {{-- <a href="#" class="mb-0 text-warning" style="font-size:18px;">Detail<i class="ti ti-arrow-right mb-1 ms-1"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Statistics -->
    <div class="row mt-4">
        <!-- Donut Chart -->
        <div class="col-md-6 col-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Asal Instansi</h5>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mb-3">
                            <div id="generatedLeadsChart"></div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <div class="d-sm-flex d-block">
                                <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                    <span class="badge badge-dot me-1" style="background-color: #F9C74F"></span> Universitas
                                </div>
                                <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                    <span class="badge badge-dot me-1" style="background-color: #90BE6D"></span> Sekolah
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Donut Chart -->
    
        <!-- Pie Chart -->
        <div class="col-md-6 col-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Rekapitulasi Mahasiswa Magang</h5>
                    </div>
    
                </div>
                <div class="card-body">
                    <div id="reportBarChart"></div>
                    {{-- <div class="row">
                        <div class="col-12 d-flex justify-content-center mb-3">
                            <div class="d-sm-flex d-block">
                                <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                    <span class="badge badge-dot me-1" style="background-color: #FF9F43"></span> Magang Fakultas
                                </div>
                                <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                    <span class="badge badge-dot me-1" style="background-color: #7B61FF"></span> Magang Mandiri
                                </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- /Pie Chart -->
    
    </div>
</div>
@endsection