<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use App\Models\Mahasiswa;
use App\Models\Universitas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $univ = Universitas::where('kategori', 1)->count();
        $sekolah = Universitas::where('kategori', 2)->count();

        // Menghitung jumlah mahasiswa
        $mahasiswa = Mahasiswa::where('status', 1)->count();

        // Menghitung jumlah jurusan
        $jurusan = JurusanModel::count();
        return view('layouts.dashboard', compact('univ', 'sekolah', 'mahasiswa', 'jurusan'));
    }
}
