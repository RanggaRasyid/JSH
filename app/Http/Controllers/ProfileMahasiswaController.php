<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileMahasiswaRequest;
use App\Models\Background;
use App\Models\JurusanModel;
use Exception;
use App\Models\Mahasiswa;
use App\Models\Pegawai;
use App\Models\Universitas;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileMahasiswaController extends Controller
{
    public function index(){
        // Mengambil data universitas dengan kategori tertentu dan mengurutkan berdasarkan kategori
        $univ = Universitas::where('kategori', 1)->count();
        $sekolah = Universitas::where('kategori', 2)->count();

        // Menghitung jumlah mahasiswa
        $mahasiswas = Mahasiswa::where('status', 1)->count();
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        // Menghitung jumlah jurusan
        $background = Background::all();
        $jurusan = JurusanModel::count();
        return view('admin.admin_dashboard', compact('mahasiswa','background','univ', 'mahasiswas', 'jurusan', 'sekolah'));
    
    }
    
    public function profile(String $id){
        $pegawai = Pegawai::all();
        $mahasiswa = Mahasiswa::where('nim', Auth::user()->nim)->with('spv', 'jurusan', 'univ')->first();
        return view('mahasiswa.profile_mahasiswa', compact('mahasiswa', 'pegawai'));
    }

    public function edit(String $id){
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        return $mahasiswa;
    }
    
    public function update(ProfileMahasiswaRequest $request, $id) 
    {
        try {
            $mahasiswa = Mahasiswa::where('nim', $id)->with('spv')->first();
            $file = null;
            if ($request->file('foto')) {
                $file = $request->file('foto')->store('profile', 'public');
            }
            $mahasiswa->posisi = $request->posisi;
            $mahasiswa->agama = $request->agama;
            $mahasiswa->id_pegawai = $request->id_pegawai;
            $mahasiswa->tempatlahirmhs = $request->tempatlahirmhs;
            $mahasiswa->tanggallahirmhs = $request->tanggallahirmhs;
            $mahasiswa->nohpmhs = $request->nohpmhs;
            $mahasiswa->alamatmhs = $request->alamatmhs;
            $mahasiswa->jeniskelamin = $request->jeniskelamin;
            $mahasiswa->foto = $file;
            if($mahasiswa->foto !=null){
                $mahasiswa->update([
                    'foto' => $file
                ]);
            }
            $mahasiswa->save();

            return response()->json([
                'error' => false,
                'message' => 'Profile successfully Updated!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
