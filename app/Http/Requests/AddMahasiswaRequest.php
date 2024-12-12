<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMahasiswaRequest extends FormRequest
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
            'namamhs' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
            'jurusan' => ['required'],
            'password' => 'required|min:8',
            'univ' => ['required'],
            'emailmhs' => 'required|email:rfc,dns',
        ];
    }

    public function messages(): array
    {
        return [

        ];
    }
}
