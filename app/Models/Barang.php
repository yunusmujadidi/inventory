<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stok',
        'harga',
        'merek_id',
        'kategori_id',
        'lokasi_id',
    ];

    protected $searchableFields = ['*'];

    public function merek()
    {
        return $this->belongsTo(Merek::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
