<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'email' => 'required|',
            'pangkat' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];
    }
}
