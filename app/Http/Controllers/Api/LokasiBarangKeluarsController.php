<?php

namespace App\Http\Controllers\Api;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangKeluarResource;
use App\Http\Resources\BarangKeluarCollection;

class LokasiBarangKeluarsController extends Controller
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

        $barangKeluars = $lokasi
            ->barangKeluars()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangKeluarCollection($barangKeluars);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lokasi $lokasi)
    {
        // $this->authorize('create', BarangKeluar::class);

        $validated = $request->validate([
            'tanggal_keluar' => ['required', 'date'],
            'jumlah_keluar' => ['required'],
            'barang_id' => ['required', 'exists:barangs,id'],
        ]);

        $barangKeluar = $lokasi->barangKeluars()->create($validated);

        return new BarangKeluarResource($barangKeluar);
    }
}