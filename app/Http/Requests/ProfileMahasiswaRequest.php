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
            'tempatlahirmhs' => 'required|max:255',
            'tanggallahirmhs' => 'required|max:255',
            'nohpmhs' => 'required|max:255',
            'alamatmhs' => 'required|max:255',
        ];
    }
}
