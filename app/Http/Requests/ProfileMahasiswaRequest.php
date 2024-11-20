<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileMahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'posisi' => 'required|max:100',
            'agama' => 'required',
            'namauniv' => 'required|max:100',
            'fakultas' => 'required|max:100',
            'jurusan' => 'required|max:100',
            'tempatlahirmhs' => 'required|max:255',
            'tanggallahirmhs' => 'required|max:255',
            'nohpmhs' => 'required|max:255|numeric',
            'alamatmhs' => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'posisi.required' => 'Posisi Wajib Di isi',
            'agama.required' => 'Agama Wajib Di isi',
            'namauniv.required' => 'Universitas Wajib Di isi',
            'fakultas.required' => 'Fakultas Wajib Di isi',
            'jurusan.required' => 'Jurusan Wajib Di isi',
            'tempatlahirmhs.required' => 'Tempat Lahir Wajib Di isi',
            'tanggallahirmhs.required' => 'Tanggal Lahir Wajib Di isi',
            'nohpmhs.required' => 'Nomor HP Wajib Di isi',
            'nohpmhs.numeric' => 'Nomor HP harus berupa angka',
            'alamatmhs.required' => 'Alamat Wajib Di isi',
        ];
    }
}
