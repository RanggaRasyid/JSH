<?php

namespace App\Http\Controllers;

use App\Models\LoogBoook;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminLogbookController extends Controller
{
    public function index() {
        $pegawai = Pegawai::where('id_pegawai', auth()->user()->id_pegawai)->first();
        $loogbookQuery = LoogBoook::where('id_pegawai', $pegawai->id_pegawai);
        $loogbook = new LoogBoook;
        $loogbook = [
            'total' => $loogbookQuery->count(),
            'pending' => $loogbookQuery->where('status', 2)->count(),
            'diterima' => $loogbookQuery->where('status', 1)->count(),
            'ditolak' => $loogbookQuery->where('status', 0)->count(),
        ]; 
        return view('spv.logbook', compact('loogbook'));
    }
    public function show(Request $request)  {
        $loogbookQuery = LoogBoook::with('nimmhs')->where('id_pegawai', Auth::user()->id_pegawai);
        if ($request->type == "pending") {
            $loogbookQuery->where('status', 2);
        } elseif ($request->type == 'diterima') {
            $loogbookQuery->where('status', 1);
        } elseif ($request->type == 'ditolak') {
            $loogbookQuery->where('status', 0);
        }
        $loogbook = $loogbookQuery->orderBy('created_at', 'desc')->get();
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

                if ($row->status !== 0) {
                $btn = "<a class='btn-icon btn-approve' data-status='{$row->status}' data-url='loogbook/approve/$row->id_loogbook' data-id='{$row->id_loogbook}'>
                            <i class='ti ti-file-check text-success'></i>
                        </a>
                        <a class='btn-icon btn-reject' data-status='{$row->status}' data-url='loogbook/tolak/$row->id_loogbook' data-id='{$row->id_loogbook}'>
                            <i class='ti ti-file-x text-danger'></i>
                        </a>";
                return $btn;
                }
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
                'table' => '#total',
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
                'table' => '#total',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
