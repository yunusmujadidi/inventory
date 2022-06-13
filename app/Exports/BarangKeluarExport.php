<?php

namespace App\Exports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangKeluarExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["Tanggal Keluar", "Jumlah", "Lokasi", "Barang"];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    //      return BarangKeluar::all();
        return BarangKeluar::select('tanggal_keluar',
        'jumlah_keluar',
        'lokasi_id',
        'barang_id',)->get();
    }
}
