<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['kategori'];

    protected $searchableFields = ['*'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
}
