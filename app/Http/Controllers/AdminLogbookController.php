<?php

namespace App\Http\Controllers;

use App\Models\LoogBoook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminLogbookController extends Controller
{
    public function index() {
        
        return view('spv.logbook');
    }
    public function show()  {
        $loogbook = LoogBoook::with('nimmhs')->where('id_pegawai', Auth::user()->id_pegawai)->orderBy('id_pegawai', 'asc')->get();

        return DataTables::of($loogbook)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d/m/y');
            })
            ->editColumn('picture', function ($row) {
                $url = Storage::url('' . $row->picture);
                return "<img src='$url' alt='Picture' style='width: 50px; height: 50px; object-fit: cover;'>";
            })
            ->editColumn('status', function ($row){
                if ($row->status == 0){
                    return "<div class='badge rounded-pill bg-label-danger'>" . "Ditolak" . "</div>";
                } elseif ($row->status == 1 ){
                    return "<div class='badge rounded-pill bg-label-success'>" . "Disetujui" . "</div>";
                } else {
                    return "<div class='badge rounded-pill bg-label-warning'>" . "Belum Disetujui" . "</div>";
                }
            })
            ->rawColumns(['action', 'picture', 'status'])
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";
                
                $btn = "<a class='btn-icon btn-approve' data-status='{$row->status}' data-url='loogbook/approve/$row->id_loogbook' data-id='{$row->id_loogbook}'>
                            <i class='ti ti-file-check text-success'></i>
                        </a>
                        <a class='btn-icon btn-reject' data-status='{$row->status}' data-url='loogbook/tolak/$row->id_loogbook' data-id='{$row->id_loogbook}'>
                            <i class='ti ti-file-x text-danger'></i>
                        </a>";
                return $btn;
            })
            ->make(true);
    }

    public function approve(String $id) {
        try {
            $data = LoogBoook::where('id_loogbook', $id)->with('nimmhs')->first();
            $data->status = 1; 
            $data->save();
            // dd($data);
    
            return response()->json([
                'error' => false,
                'message' => 'Approval Loogbook berhasil!',
                'table' => '#table-loogbook-admin',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
    
    public function rejected($id, Request $request) {
        try {
            $data = LoogBoook::where('id_loogbook', $id)->with('nimmhs')->first();
            $data->status = 0;
            $data->save();
    
            return response()->json([
                'error' => false,
                'message' => 'Penolakan Loogbook berhasil!',
                'table' => '#table-loogbook-admin',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
