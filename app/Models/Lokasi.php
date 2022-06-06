<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasi extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['lokasi'];

    protected $searchableFields = ['*'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
