<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\JurusanModel;
use App\Models\Mahasiswa;
use App\Models\Universitas;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil data universitas dengan kategori tertentu dan mengurutkan berdasarkan kategori
        $univ = Universitas::where('kategori', 1)->count();
        $sekolah = Universitas::where('kategori', 2)->count();

        // Menghitung jumlah mahasiswa
        $mahasiswa = Mahasiswa::where('status', 1)->count();

        // Menghitung jumlah jurusan
        $jurusan = JurusanModel::count();
        return view('admin.admin_dashboard', compact('univ', 'mahasiswa', 'jurusan', 'sekolah'));
    }
    
}
