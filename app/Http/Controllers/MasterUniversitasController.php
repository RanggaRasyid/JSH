<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversitasRequest;
use App\Models\Universitas;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterUniversitasController extends Controller
{
    public function index(){
        return view('admin.master.master_universitas');
    }

    public function show(){
        $univ = Universitas::orderBy('id_univ', 'asc')->get();
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

            $btn = "<a data-bs-toggle='modal' data-id='{$row->id_univ}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>
            <a data-status='{$row->status}' data-id='{$row->id_univ}' data-url='master-universitas/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status'])

        ->make(true);
    }

    public function store(UniversitasRequest $request) {
        try {
            $univ = Universitas::create([
                'namauniv' => $request->namauniv,
                'status' => 1
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Universitas successfully Created!',
                'modal' => '#modal-master-universitas',
                'table' => '#table-master-universitas'
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
            $univ = Universitas::where('id_univ', $id)->first();
            $univ->status = ($univ->status) ? false : true;
            $univ->save();

            return response()->json([
                'error' => false,
                'message' => 'Status univ successfully Updated!',
                'table' => '#table-master-universitas'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
