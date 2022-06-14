<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangKeluarResource;
use App\Http\Resources\BarangKeluarCollection;

class BarangBarangKeluarsController extends Controller
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

        $barangKeluars = $barang
            ->barangKeluars()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangKeluarCollection($barangKeluars);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Barang $barang)
    {
        // $this->authorize('create', BarangKeluar::class);

        $validated = $request->validate([
            'tanggal_keluar' => ['required', 'date'],
            'jumlah_keluar' => ['required'],
            'lokasi_id' => ['required', 'exists:lokasis,id'],
        ]);

        $barangKeluar = $barang->barangKeluars()->create($validated);

        return new BarangKeluarResource($barangKeluar);
    }
}