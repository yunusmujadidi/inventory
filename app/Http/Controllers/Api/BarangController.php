<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Http\Resources\BarangCollection;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;

class BarangController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view-any', Barang::class);

        $search = $request->get('search', '');

        $barangs = Barang::search($search)
            ->latest()
            ->paginate();

        return new BarangCollection($barangs);
    }

    /**
     * @param \App\Http\Requests\BarangStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangStoreRequest $request)
    {
        // $this->authorize('create', Barang::class);

        $validated = $request->validated();

        $barang = Barang::create($validated);

        return new BarangResource($barang);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Barang $barang)
    {
        // $this->authorize('view', $barang);

        return new BarangResource($barang);
    }

    /**
     * @param \App\Http\Requests\BarangUpdateRequest $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function update(BarangUpdateRequest $request, Barang $barang)
    {
        // $this->authorize('update', $barang);

        $validated = $request->validated();

        $barang->update($validated);

        return new BarangResource($barang);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Barang $barang)
    {
        // $this->authorize('delete', $barang);

        $barang->delete();

        return response()->noContent();
    }
}