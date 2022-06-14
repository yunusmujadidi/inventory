<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Http\Resources\BarangCollection;

class KategoriBarangsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Kategori $kategori)
    {
        // $this->authorize('view', $kategori);

        $search = $request->get('search', '');

        $barangs = $kategori
            ->barangs()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangCollection($barangs);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kategori $kategori)
    {
        // $this->authorize('create', Barang::class);

        $validated = $request->validate([
            'kode_barang' => ['required', 'max:255'],
            'nama_barang' => ['required', 'max:255'],
            'stok' => ['required', 'max:255'],
            'harga' => ['required', 'numeric'],
            'merek_id' => ['required', 'exists:mereks,id'],
            'lokasi_id' => ['required', 'exists:lokasis,id'],
        ]);

        $barang = $kategori->barangs()->create($validated);

        return new BarangResource($barang);
    }
}