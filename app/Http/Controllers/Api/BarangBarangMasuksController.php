<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangMasukResource;
use App\Http\Resources\BarangMasukCollection;

class BarangBarangMasuksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Barang $barang)
    {
        // $this->authorize('view', $barang);

        $search = $request->get('search', '');

        $barangMasuks = $barang
            ->barangMasuks()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangMasukCollection($barangMasuks);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Barang $barang)
    {
        // $this->authorize('create', BarangMasuk::class);

        $validated = $request->validate([
            'tanggal_masuk' => ['required', 'date'],
            'jumlah_masuk' => ['required'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
        ]);

        $barangMasuk = $barang->barangMasuks()->create($validated);

        return new BarangMasukResource($barangMasuk);
    }
}