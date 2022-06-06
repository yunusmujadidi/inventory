<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merek extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['merek'];

    protected $searchableFields = ['*'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
