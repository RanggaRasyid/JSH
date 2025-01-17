<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminPresensiController extends Controller
{
    public function index(){
        return view('admin.presensimhs');
    }

    public function show(){

        $mahasiswa = Mahasiswa::with('jurusan', 'univ')->orderBy('nim', 'asc')->get();

        return DataTables::of($mahasiswa)
        ->addIndexColumn()
        ->addColumn('detail', function ($row) {
            $btn =
            "<a href='/supervisor/presensi/show-detail/$row->nim' data-id='{$row->nim}' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>";
            return $btn;
        })
        ->rawColumns(['detail'])

        ->make(true);
    }
}
