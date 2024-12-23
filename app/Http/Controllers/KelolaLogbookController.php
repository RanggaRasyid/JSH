<?php

namespace App\Http\Controllers;

use App\Models\LoogBoook;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KelolaLogbookController extends Controller
{
    public function index() {
        return view('admin.logbook');
    }

    public function show()  {
        $loogbook = LoogBoook::with('nimmhs')
            ->orderBy('nim', 'asc')
            ->get();

        return DataTables::of($loogbook)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d/m/y');
            })
            ->editColumn('picture', function ($row) {
                $url = Storage::url('' . $row->picture);
                return "<img src='$url' alt='Picture' style='width: 50px; height: 50px; object-fit: cover;'>";
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-status='{$row->status}' data-id='{$row->id_loogbook}' data-url='logbook/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
                return $btn;
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
            ->make(true);
    }

    public function status(String $id)
    {
        try {
            $logbook = LoogBoook::where('id_loogbook', $id)->first();
            $logbook->status = ($logbook->status) ? false : true;
            $logbook->save();

            return response()->json([
                'error' => false,
                'message' => 'Approval Loogbook successfully!',
                'table' => '#table-loogbook-admin'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),

            ]);
        }
    }
}
