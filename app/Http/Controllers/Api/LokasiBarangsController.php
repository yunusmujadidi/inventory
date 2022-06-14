<?php

namespace App\Http\Controllers\Api;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Http\Resources\BarangCollection;

class LokasiBarangsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Lokasi $lokasi)
    {
        // $this->authorize('view', $lokasi);

        $search = $request->get('search', '');

        $barangs = $lokasi
            ->barangs()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangCollection($barangs);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lokasi $lokasi)
    {
        // $this->authorize('create', Barang::class);

        $validated = $request->validate([
            'kode_barang' => ['required', 'max:255'],
            'nama_barang' => ['required', 'max:255'],
            'stok' => ['required', 'max:255'],
            'harga' => ['required', 'numeric'],
            'merek_id' => ['required', 'exists:mereks,id'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
        ]);

        $barang = $lokasi->barangs()->create($validated);

        return new BarangResource($barang);
    }
}