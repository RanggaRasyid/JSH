<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileMahasiswaRequest;
use App\Models\JurusanModel;
use Exception;
use App\Models\Mahasiswa;
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
        $mahasiswa = Mahasiswa::where('status', 1)->count();

        // Menghitung jumlah jurusan
        $jurusan = JurusanModel::count();
        return view('admin.admin_dashboard', compact('univ', 'mahasiswa', 'jurusan', 'sekolah'));
    
    }
    
    public function profile(String $id){
        $mahasiswa = Mahasiswa::where('nim', Auth::user()->nim)->with('jurusan', 'univ')->first();
        return view('mahasiswa.profile_mahasiswa', compact('mahasiswa'));
    }

    public function edit(String $id){
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        return $mahasiswa;
    }
    
    public function update(ProfileMahasiswaRequest $request, $id) 
    {
        try {
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            $file = null;
            if ($request->file('foto')) {
                $file = Storage::put('public/loogbook' , $request->file('foto'));
            }
            $mahasiswa->posisi = $request->posisi;
            $mahasiswa->agama = $request->agama;
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
                'modal' => '#modal-profile-mhs',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
