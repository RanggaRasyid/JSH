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
            if ($row->mahasiswa->status == 1) {
                return "<div'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
            } else {
                return "<div'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
            }
        })
        ->addColumn('action', function ($row) {
            $icon = ($row->mahasiswa->status) ? "ti-circle-x" : "ti-circle-check";
            $color = ($row->mahasiswa->status) ? "danger" : "success";

            $btn = "
            <a data-status='{$row->mahasiswa->status}' data-id='{$row->mahasiswa->nim}' data-url='master-masa-magang/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>
            <a data-bs-toggle='modal' data-id='{$row->id_masa_magang}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>";
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
            $mahasiswa = Mahasiswa::where('nim', $request->mahasiswa)->first();

            if ($mahasiswa) {
                // Update id_masa_magang di tabel Mahasiswa
                $mahasiswa->id_masa_magang = $masamagang->id_masa_magang; // Gunakan id dari $masamagang
                $mahasiswa->save();
            }

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
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            $mahasiswa->status = ($mahasiswa->status) ? false : true;
            $mahasiswa->save();

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
