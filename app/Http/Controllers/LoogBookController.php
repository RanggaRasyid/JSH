<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoogbookRequest;
use App\Models\LoogBoook;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class LoogBookController extends Controller
{
    public function index() {

        return view('mahasiswa.loogbook.loogbook');
    }

    public function show()  {
        $loogbook = LoogBoook::with('nimmhs')->where('nim', Auth::user()->nim)
            ->orderBy('nim', 'asc')
            ->get();

        return DataTables::of($loogbook)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d/m/y');
            })
            ->editColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->format('d/m/y');
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
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_loogbook}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i></a>
                <a data-id='{$row->id_loogbook}' data-url='loogbook/destroy' class='btn-icon delete-data waves-effect waves-light'><i class='ti ti-trash fa-lg' style='color:red'></i></a>";
                return $btn;
            })
            ->rawColumns(['action', 'picture', 'status'])
            ->make(true);
    }

    public function store(LoogbookRequest $request) {
        try {

            $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();

            $file = null;
            if ($request->file('picture')) {
                $file = Storage::put('public/loogbook' , $request->file('picture'));
            }

            $loogbook = LoogBoook::create([
                'nim' => $mahasiswa->nim,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'picture' => $file,
                'status' => 2

            ]);
            return response()->json([
                'error' => false,
                'message' => 'Loogbook successfully Created!',
                'modal' => '#modal-loogbook',
                'table' => '#table-loogbook-mahasiswa'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(String $id) {

        $loogbook = LoogBoook::Where('id_loogbook', $id)->first();
        return $loogbook;

    }

    public function update(LoogbookRequest $request, $id){
        try {
            $file = null;
            if ($request->file('picture')) {
                $file = Storage::put('public/loogbook' , $request->file('picture'));
            }
            $loogbook = LoogBoook::Where('id_loogbook', $id)->first();
            $loogbook->nama = $request->nama;
            $loogbook->deskripsi = $request->deskripsi;
            $loogbook->picture = $file;
            $loogbook->status = 2;
            $loogbook->save();
            return response()->json([
                'error' => false,
                'message' => 'Loogbook successfully Updated!',
                'modal' => '#modal-loogbook',
                'table' => '#table-loogbook-mahasiswa'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id) {
        try {
            $loogbook = LoogBoook::Where('id_loogbook', $id)->first();
            if ($loogbook) {
                $loogbook->delete();
                return response()->json([
                    'error' => false,
                    'message' => 'Loogbook successfully deleted!',
                    'table' => '#table-loogbook-mahasiswa'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Loogbook not found!',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
