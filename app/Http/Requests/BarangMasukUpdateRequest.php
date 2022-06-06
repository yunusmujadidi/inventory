<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangMasukUpdateRequest extends FormRequest
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
            'tanggal_masuk' => ['required', 'date'],
            'jumlah_masuk' => ['required'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'barang_id' => ['required', 'exists:barangs,id'],
        ];
    }
}
