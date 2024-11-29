<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BridesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'men_name'          => 'required',
            'men_nickname'          => 'required',
            'men_desc'          => 'required',
            'women_name'          => 'required',
            'women_nickname'          => 'required',
            'women_desc'          => 'required',
            'men_photo'     => ['required', 'mimes:jpg,png', 'max:512'],
            'women_photo'     => ['required', 'mimes:jpg,png', 'max:512']
        ];
    }

    public function messages(): array
    {
        return [
            'men_name.required'     => 'Nama mempelai pria wajib diisi',
            'men_nickname.required'     => 'Nama panggilan mempelai pria wajib diisi',
            'men_desc.required'     => 'Deskripsi mempelai pria wajib diisi',
            'women_name.required'     => 'Nama mempelai pria wajib diisi',
            'women_nickname.required'     => 'Nama panggilan mempelai pria wajib diisi',
            'women_desc.required'     => 'Deskripsi mempelai pria wajib diisi'
        ];
    }
}
