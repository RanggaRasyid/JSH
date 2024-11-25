<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Models\Pegawai;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class MasterPegawaiController extends Controller
{
    public function index(){
        return view('admin.master.master_pegawai');
    }

    public function show(){
        $univ = Pegawai::orderBy('id_pegawai', 'asc')->get();
        return DataTables::of($univ)
        ->addIndexColumn()
        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
            } else {
                return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
            }
        })
        ->addColumn('action', function ($row) {
            $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
            $color = ($row->status) ? "danger" : "success";

            $btn = "<a data-bs-toggle='modal' data-id='{$row->id_pegawai}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>
            <a data-status='{$row->status}' data-id='{$row->id_pegawai}' data-url='data-pegawai/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status'])

        ->make(true);
    }

    public function store(PegawaiRequest $request) {
        try {
            $univ = Pegawai::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'pangkat' => $request->nama,
                'status' => 1
            ]);
            $users = User::create([
                'id_pegawai' => $univ->id_pegawai,
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Pegawai successfully Created!',
                'modal' => '#modal-master-pegawai',
                'table' => '#table-master-pegawai'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function status(String $id)
    {
        try {
            $pegawai = Pegawai::where('id_pegawai', $id)->first();
            $pegawai->status = ($pegawai->status) ? false : true;
            $pegawai->save();

            return response()->json([
                'error' => false,
                'message' => 'Status pegawai successfully Updated!',
                'table' => '#table-master-pegawai'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
