<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangUpdateRequest extends FormRequest
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
            'kode_barang' => ['required', 'max:255'],
            'nama_barang' => ['required', 'max:255'],
            'stok' => ['required', 'max:255'],
            'harga' => ['required', 'numeric'],
            'merek_id' => ['required', 'exists:mereks,id'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'lokasi_id' => ['required', 'exists:lokasis,id'],
        ];
    }
}
