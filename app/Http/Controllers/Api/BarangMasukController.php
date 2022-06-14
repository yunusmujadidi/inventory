<?php

namespace App\Http\Controllers\Api;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangMasukResource;
use App\Http\Resources\BarangMasukCollection;
use App\Http\Requests\BarangMasukStoreRequest;
use App\Http\Requests\BarangMasukUpdateRequest;

class BarangMasukController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view-any', BarangMasuk::class);

        $search = $request->get('search', '');

        $barangMasuks = BarangMasuk::search($search)
            ->latest()
            ->paginate();

        return new BarangMasukCollection($barangMasuks);
    }

    /**
     * @param \App\Http\Requests\BarangMasukStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangMasukStoreRequest $request)
    {
        // $this->authorize('create', BarangMasuk::class);

        $validated = $request->validated();

        $barangMasuk = BarangMasuk::create($validated);

        return new BarangMasukResource($barangMasuk);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangMasuk $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BarangMasuk $barangMasuk)
    {
        // $this->authorize('view', $barangMasuk);

        return new BarangMasukResource($barangMasuk);
    }

    /**
     * @param \App\Http\Requests\BarangMasukUpdateRequest $request
     * @param \App\Models\BarangMasuk $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(
        BarangMasukUpdateRequest $request,
        BarangMasuk $barangMasuk
    ) {
        // $this->authorize('update', $barangMasuk);

        $validated = $request->validated();

        $barangMasuk->update($validated);

        return new BarangMasukResource($barangMasuk);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangMasuk $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BarangMasuk $barangMasuk)
    {
        // $this->authorize('delete', $barangMasuk);

        $barangMasuk->delete();

        return response()->noContent();
    }
}