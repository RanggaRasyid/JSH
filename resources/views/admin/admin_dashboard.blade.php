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
</div>
@endsection