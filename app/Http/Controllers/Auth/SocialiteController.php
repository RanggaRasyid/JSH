<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataMahasiswaReq;
use App\Models\JurusanModel;
use App\Models\Mahasiswa;
use App\Models\SocialAccount;
use App\Models\Universitas;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Expr\Assign;

class SocialiteController extends Controller
{
    public function redirect () {
        return Socialite::driver('google')->redirect();
     }
    
    public function callback() {
    $socialite = Socialite::driver('google')->user();
    
    $register = User::where('google_id', $socialite->id)->first();

    if (!$register){

        $user = User::updateOrCreate([
            'google_id' => $socialite->id,
        ], [
            'name' => $socialite->name,
            'email' => $socialite->email,
            'password' => Hash::make('12345678'),
            'google_token' => $socialite->token,
            'google_refresh_token' => $socialite->refreshToken,
        ]);
        $user->assignRole('mahasiswa');
        Auth::login($user);
        
        return redirect('mahasiswa/data');
        
        }
        Auth::login($register);
        $user = User::where('nim', $register->nim)->with('mahasiswa')->first();
        if ($user->nim == null){
            return redirect('mahasiswa/data');
        }elseif($user->mahasiswa->status == 0){
            auth()->logout();
            return view('auth.aktifasi');
        } else {
            return redirect('mahasiswa/dashboard');
        }
    }
    
    public function data() {
        $univ = Universitas::all();
        $jurusan = JurusanModel::all();
        return view('auth.data', compact('univ', 'jurusan'));
    }

    public function created(DataMahasiswaReq $request) {
        try {
            $user = User::where('id', auth()->user()->id)->first();    
            $mahasiswa = Mahasiswa::create([
                'nim' => $request->nim,
                'namamhs' => $user->name,
                'emailmhs' => $user->email,
                'id_univ' => $request->univ,
                'id_jurusan' => $request->jurusan,
                'status' => 0
            ]);

            $user->nim = $mahasiswa->nim; 
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'error' => false,
                'message' => 'Data Mahasiswa Berhasil Dibuat, hubungi admin jsh untuk aktivasi akun',
                'url' => Auth::logout()
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
         }
    }

    public function aktivasi(Request $request) {
        return view('auth.konfirmasi');
    }
 }