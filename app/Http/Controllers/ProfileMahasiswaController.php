<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileMahasiswaRequest;
use Exception;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProfileMahasiswaController extends Controller
{
    public function index(){
        return view('admin.admin_dashboard');
    }
    
    public function profile(String $id){
        $mahasiswa = Mahasiswa::where('nim', Auth::user()->nim)->with('jurusan', 'univ')->first();
        return view('mahasiswa.profile_mahasiswa', compact('mahasiswa'));
    }

    public function edit(String $id){
        $mahasiswa = Mahasiswa::where('nim', Auth::user()->nim)->with('jurusan', 'univ')->first();
        return $mahasiswa;
    }
    
    public function update(ProfileMahasiswaRequest $request, $id) 
    {
        try {
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            $mahasiswa->posisi = $request->posisi;
            $mahasiswa->agama = $request->agama;
            $mahasiswa->tempatlahirmhs = $request->tempatlahirmhs;
            $mahasiswa->tanggallahirmhs = $request->tanggallahirmhs;
            $mahasiswa->nohpmhs = $request->nohpmhs;
            $mahasiswa->alamatmhs = $request->alamatmhs;
            $mahasiswa->jeniskelamin = $request->jeniskelamin;
            $mahasiswa->save();

            return response()->json([
                'error' => false,
                'message' => 'Mahasiswa successfully Updated!',
                'modal' => '#modal-profile-mhs'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
