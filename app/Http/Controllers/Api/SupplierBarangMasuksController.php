<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangMasukResource;
use App\Http\Resources\BarangMasukCollection;

class SupplierBarangMasuksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Supplier $supplier)
    {
        $this->authorize('view', $supplier);

        $search = $request->get('search', '');

        $barangMasuks = $supplier
            ->barangMasuks()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangMasukCollection($barangMasuks);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Supplier $supplier)
    {
        $this->authorize('create', BarangMasuk::class);

        $validated = $request->validate([
            'tanggal_masuk' => ['required', 'date'],
            'jumlah_masuk' => ['required'],
            'barang_id' => ['required', 'exists:barangs,id'],
        ]);

        $barangMasuk = $supplier->barangMasuks()->create($validated);

        return new BarangMasukResource($barangMasuk);
    }
}
