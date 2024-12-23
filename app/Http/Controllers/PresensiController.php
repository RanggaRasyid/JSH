<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Presensi;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PresensiController extends Controller
{
    public function index() {
        return view('mahasiswa.presensi.presensi');
    }

    public function show() {
        $presensi = Presensi::with('mahasiswa')->where('nim', Auth::user()->nim);
        $presensi = $presensi->orderBy('nim', 'asc')->get();
        return DataTables::of($presensi)
        ->addIndexColumn()
        ->editColumn('tgl', function ($row) {
            return Carbon::parse($row->created_at)->format('d/m/y');
        })
        ->editColumn('status', function ($row) {
            return $row->status == 1 ? 'Hadir' : 'Tidak Hadir';
        })
        ->make(true);
    }

    public function store(){
        try {
            $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();

            // Cek apakah sudah check-in dan check-out hari ini
            $today = Carbon::now('Asia/Jakarta')->toDateString();
            $presensiHariIni = Presensi::where('nim', $mahasiswa->nim)
                ->whereDate('tgl', $today)
                ->whereNotNull('jamkeluar')
                ->first();

            if ($presensiHariIni) {
                // Jika sudah check-out hari ini, beri respons error atau keterangan
                return response()->json([
                    'error' => true,
                    'message' => 'Anda sudah melakukan check-in dan check-out hari ini.',
                ]);
            }

            // Cek apakah mahasiswa sudah check-in tapi belum check-out
            $presensi = Presensi::where('nim', $mahasiswa->nim)
                ->whereDate('tgl', $today)
                ->whereNull('jamkeluar')
                ->first();

            // Cek jika belum check-in dan waktu sudah lewat jam 17.00
            $now = Carbon::now('Asia/Jakarta');
            if (!$presensi && $now->hour >= 17) {
                // Jika belum check-in dan sudah lewat jam 17:00, set status menjadi 0 (tidak hadir)
                $presensi = Presensi::create([
                    'nim' => $mahasiswa->nim,
                    'jammasuk' => Carbon::now('Asia/Jakarta'), // Tidak ada jam masuk, karena statusnya tidak hadir
                    'status' => 0,      // Status tidak hadir
                    'tgl' => $today
                ]);

                $message = 'Anda tidak hadir karena tidak check-in sebelum jam 17:00.';
            } else if ($presensi) {
                // Jika sudah check-in, lakukan check-out
                $presensi->update([
                    'jamkeluar' => Carbon::now('Asia/Jakarta'),
                ]);

                $message = 'anda tidak hadir!';
            } else {
                // Jika belum check-in, lakukan check-in
                $presensi = Presensi::create([
                    'nim' => $mahasiswa->nim,
                    'jammasuk' => Carbon::now('Asia/Jakarta'),
                    'status' => 1, // Status hadir
                    'tgl' => $today
                ]);

                $message = 'Check-in berhasil!';
            }

            return response()->json([
                'error' => false,
                'message' => $message,
                'table' => '#table-presensi-mahasiswa'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
