<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangKeluar extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'tanggal_keluar',
        'jumlah_keluar',
        'lokasi_id',
        'barang_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'barang_keluars';

    protected $casts = [
        'tanggal_keluar' => 'datetime',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
