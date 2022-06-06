<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama_supplier' => ['required', 'max:255', 'string'],
            'alamat' => ['required', 'max:255'],
            'telp' => ['required'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
        ];
    }
}
