<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasuk extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'tanggal_masuk',
        'jumlah_masuk',
        'supplier_id',
        'barang_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'barang_masuks';

    protected $casts = [
        'tanggal_masuk' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
