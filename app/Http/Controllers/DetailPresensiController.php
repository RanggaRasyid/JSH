<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DetailPresensiController extends Controller
{
    public function index($id){
        $presensi = Presensi::with('nimmhs')->where('nim', $id)->first();
        return view('admin.detail_presensimhs', compact('presensi'));
    }

    public function detail($id){
        $detailpresensi = Presensi::with('nimmhs')
        ->orderBy('tgl', 'desc')
        ->get(); 
        return DataTables::of($detailpresensi)
        ->addIndexColumn()
        ->editColumn('tgl', function ($row) {
            return Carbon::parse($row->created_at)->format('d/m/y');
        })
        ->editColumn('status', function ($row) {
            return $row->status == 1 ? 'Hadir' : 'Tidak Hadir';
        })
        ->rawColumns(['detail'])
        ->make(true);
        
    }
}
