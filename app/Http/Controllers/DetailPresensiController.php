<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DetailPresensiController extends Controller
{
    public function index($id){
        $mahasiswa = Mahasiswa::where('nim', $id)->first(); // Cari data mahasiswa
        return view('admin.detail_presensimhs', compact('mahasiswa'));
    }

    public function detail($id)
    {
        // Filter data presensi berdasarkan nim
        $detailpresensi = Presensi::where('nim', $id)
            ->with('mahasiswa') // Ambil data relasi mahasiswa
            ->orderBy('tgl', 'desc')
            ->get();

        // Kembalikan data dalam format DataTables
        return DataTables::of($detailpresensi)
            ->addIndexColumn()
            ->editColumn('tgl', function ($row) {
                // Format tanggal sesuai kebutuhan
                return Carbon::parse($row->tgl)->format('d/m/y');
            })
            ->editColumn('status', function ($row) {
                // Tampilkan status Hadir/Tidak Hadir
                return $row->status == 1 ? 'Hadir' : 'Tidak Hadir';
            })
            ->make(true);
    }
}
