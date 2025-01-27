<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SebastianBergmann\Type\TrueType;

class BackgroundRequest extends FormRequest
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
            'deskripsi' => 'required',
            'picture' => [
                'required', 
                'image', 
                'mimes:jpeg,png,jpg', 
                'max:2048', // Maksimal ukuran file 2MB
                // 'dimensions:min_width=700,max_width=1900,min_height=300,max_height=400',
            ],
        ];

    }
    public function messages()
    {
        return [
            'deskripsi.required' => 'Deskripsi Harus Di Isi',
            'picture.required' => 'Gambar Harus Di Isi',
            'picture.image' => 'Gambar Harus Bentuk JPEG, JPG, PNG',
            'picture.mimes' => 'Format gambar harus berupa JPEG, JPG, atau PNG.',
            'picture.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            // 'picture.dimensions' => 'Dimensi gambar harus memiliki rasio 19:8.',
        ];
    }
}
