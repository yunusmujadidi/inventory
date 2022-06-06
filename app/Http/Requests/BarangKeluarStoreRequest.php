<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangKeluarStoreRequest extends FormRequest
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
            'tanggal_keluar' => ['required', 'date'],
            'jumlah_keluar' => ['required'],
            'lokasi_id' => ['required', 'exists:lokasis,id'],
            'barang_id' => ['required', 'exists:barangs,id'],
        ];
    }
}
