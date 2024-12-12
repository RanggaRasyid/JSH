<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurusanRequest;
use App\Models\JurusanModel;
use App\Models\Universitas;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterJurusanController extends Controller
{
    public function index(){
        $univ = Universitas::all();
        return view('admin.master.master_jurusan', compact('univ'));
    }

    public function show(){
        $jurusan = JurusanModel::with('univ')->orderBy('id_jurusan', 'asc')->get();
        return DataTables::of($jurusan)
        ->addIndexColumn()
        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
            } else {
                return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
            }
        })
        ->editColumn('univ.kategori', function ($row) {
            if ($row->univ->kategori == 1) {
                return "<div class=''>" . "SMA/SMK" . "</div>";
            } else {
                return "<div class=''>" . "Perguruan Tinggi" . "</div>";
            }
        })
        ->addColumn('action', function ($row) {
            $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
            $color = ($row->status) ? "danger" : "success";

            $btn = "<a data-bs-toggle='modal' data-id='{$row->id_jurusan}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>
            <a data-status='{$row->status}' data-id='{$row->id_jurusan}' data-url='master-jurusan/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status', 'univ.kategori'])

        ->make(true);
    }

    public function store(JurusanRequest $request) {
        try {
            $jurusan = JurusanModel::create([
                'jurusan' => $request->jurusan,
                'id_univ' => $request->univ,
                'status' => 1
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Jurusan successfully Created!',
                'modal' => '#modal-master-jurusan',
                'table' => '#table-master-jurusan'
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
            $jurusan = JurusanModel::where('id_jurusan', $id)->first();
            $jurusan->status = ($jurusan->status) ? false : true;
            $jurusan->save();

            return response()->json([
                'error' => false,
                'message' => 'Status jurusan successfully Updated!',
                'table' => '#table-master-jurusan'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(String $id) {
        $jurusan = JurusanModel::Where('id_jurusan', $id)->first();
        return $jurusan;
    }

    public function update(JurusanRequest $request, $id) {
        try {
            $jurusan = JurusanModel::Where('id_jurusan', $id)->first();
            $jurusan->jurusan = $request->jurusan;
            $jurusan->id_univ = $request->univ;
            $jurusan->save();
            return response()->json([
                'error' => false,
                'message' => 'Jurusan successfully Created!',
                'modal' => '#modal-master-jurusan',
                'table' => '#table-master-jurusan'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
