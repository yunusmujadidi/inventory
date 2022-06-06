<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama_supplier', 'alamat', 'telp', 'kategori_id'];

    protected $searchableFields = ['*'];

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
