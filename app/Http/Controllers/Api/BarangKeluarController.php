<?php

namespace App\Http\Controllers\Api;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangKeluarResource;
use App\Http\Resources\BarangKeluarCollection;
use App\Http\Requests\BarangKeluarStoreRequest;
use App\Http\Requests\BarangKeluarUpdateRequest;

class BarangKeluarController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view-any', BarangKeluar::class);

        $search = $request->get('search', '');

        $barangKeluars = BarangKeluar::search($search)
            ->latest()
            ->paginate();

        return new BarangKeluarCollection($barangKeluars);
    }

    /**
     * @param \App\Http\Requests\BarangKeluarStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangKeluarStoreRequest $request)
    {
        // $this->authorize('create', BarangKeluar::class);

        $validated = $request->validated();

        $barangKeluar = BarangKeluar::create($validated);

        return new BarangKeluarResource($barangKeluar);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangKeluar $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BarangKeluar $barangKeluar)
    {
        // $this->authorize('view', $barangKeluar);

        return new BarangKeluarResource($barangKeluar);
    }

    /**
     * @param \App\Http\Requests\BarangKeluarUpdateRequest $request
     * @param \App\Models\BarangKeluar $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(
        BarangKeluarUpdateRequest $request,
        BarangKeluar $barangKeluar
    ) {
        // $this->authorize('update', $barangKeluar);

        $validated = $request->validated();

        $barangKeluar->update($validated);

        return new BarangKeluarResource($barangKeluar);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangKeluar $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BarangKeluar $barangKeluar)
    {
        // $this->authorize('delete', $barangKeluar);

        $barangKeluar->delete();

        return response()->noContent();
    }
}