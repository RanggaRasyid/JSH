<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Universitas;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'integer', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'univ' => ['required'],
            'jurusan' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => $data['nim'],
            'namamhs' => $data['name'],
            'emailmhs' => $data['email'],
            'id_univ' => $data['univ'],
            'id_jurusan' => $data['jurusan'],
            'status' => 0
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nim' => $data['nim'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('mahasiswa');
        return $user;
    }
    public function register(Request $request)
    {
        // Validasi data input
        $this->validator($request->all())->validate();

        // Buat data user dan mahasiswa
        event(new Registered($user = $this->create($request->all())));

        // Tidak login secara otomatis, hanya redirect
        return view('auth.konfirmasi');
    }

}
