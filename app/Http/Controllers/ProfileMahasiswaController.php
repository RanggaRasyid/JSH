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
        return view('mahasiswa.dashboard');
    }
    
    public function profile($id){
        $mahasiswa = Mahasiswa::where('nim', Auth::user()->nim)->first();
        return view('mahasiswa.profile_mahasiswa', compact('mahasiswa'));
    }
    
    public function update(Request $request, $id) 
    {
        try {
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            $mahasiswa->posisi = $request->division;
            $mahasiswa->agama = $request->religion;
            $mahasiswa->namauniv = $request->univ;
            $mahasiswa->fakultas = $request->fakultas;
            $mahasiswa->jurusan = $request->prodi;
            $mahasiswa->tempatlahirmhs = $request->place;
            $mahasiswa->tanggallahirmhs = $request->birth;
            $mahasiswa->nohpmhs = $request->phoneNumber;
            $mahasiswa->alamatmhs = $request->address;
            // $mahasiswa->gender1 = $request->jeniskelamin;
            $mahasiswa->save();

            return response()->json([
                'error' => false,
                'message' => 'Mahasiswa successfully Updated!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
