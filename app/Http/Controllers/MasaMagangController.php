<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasaMagangRequest;
use App\Http\Requests\MasaUpdateRequest;
use App\Models\Mahasiswa;
use App\Models\MasaMagang;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasaMagangController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::all();
        return view('admin.master.master_masa_magang', compact('mahasiswa'));
    }

    public function show(){

        $masamagang = MasaMagang::with('mahasiswa')->orderBy('nim', 'asc')->get();
        return DataTables::of($masamagang)
        ->addIndexColumn()
        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return "<div'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
            } else {
                return "<div'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
            }
        })
        ->addColumn('action', function ($row) {
            $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
            $color = ($row->status) ? "danger" : "success";

            $btn = "<a data-bs-toggle='modal' data-id='{$row->id_masa_magang}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>
            <a data-status='{$row->status}' data-id='{$row->id_masa_magang}' data-url='master-masa-magang/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status'])

        ->make(true);
    }

    public function store(MasaMagangRequest $request) {
        try {
            $masamagang = MasaMagang::create([
                'startdate' => $request->startdate,
                'enddate' => $request->enddate,
                'nim' => $request->mahasiswa,
                'status' => 1
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Masa Magang successfully Created!',
                'modal' => '#modal-master-masa-magang',
                'table' => '#table-master-masa-magang'
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
            $masamagang = MasaMagang::where('id_masa_magang', $id)->first();
            $masamagang->status = ($masamagang->status) ? false : true;
            $masamagang->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Masa Magang successfully Updated!',
                'table' => '#table-master-masa-magang'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),

            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $masamagang = MasaMagang::where('id_masa_magang', $id)->first();
        return $masamagang;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MasaUpdateRequest $request, $id)
    {
        try {
            $masamagang = MasaMagang::where('id_masa_magang', $id)->with('mahasiswa')->first();
            $masamagang->startdate = $request->startdate;
            $masamagang->enddate = $request->enddate;
            $masamagang->save();

            return response()->json([
                'error' => false,
                'message' => 'Mahasiswa successfully Updated!',
                'modal' => '#modal-master-masa-magang',
                'table' => '#table-master-masa-magang'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
