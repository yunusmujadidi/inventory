<?php

namespace App\Http\Controllers\Api;

use App\Models\Merek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Http\Resources\BarangCollection;

class MerekBarangsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Merek $merek)
    {
        // $this->authorize('view', $merek);

        $search = $request->get('search', '');

        $barangs = $merek
            ->barangs()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangCollection($barangs);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Merek $merek)
    {
        // $this->authorize('create', Barang::class);

        $validated = $request->validate([
            'kode_barang' => ['required', 'max:255'],
            'nama_barang' => ['required', 'max:255'],
            'stok' => ['required', 'max:255'],
            'harga' => ['required', 'numeric'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'lokasi_id' => ['required', 'exists:lokasis,id'],
        ]);

        $barang = $merek->barangs()->create($validated);

        return new BarangResource($barang);
    }
}