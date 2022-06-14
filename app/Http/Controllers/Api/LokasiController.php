<?php

namespace App\Http\Controllers\Api;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LokasiResource;
use App\Http\Resources\LokasiCollection;
use App\Http\Requests\LokasiStoreRequest;
use App\Http\Requests\LokasiUpdateRequest;

class LokasiController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view-any', Lokasi::class);

        $search = $request->get('search', '');

        $lokasis = Lokasi::search($search)
            ->latest()
            ->paginate();

        return new LokasiCollection($lokasis);
    }

    /**
     * @param \App\Http\Requests\LokasiStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LokasiStoreRequest $request)
    {
        // $this->authorize('create', Lokasi::class);

        $validated = $request->validated();

        $lokasi = Lokasi::create($validated);

        return new LokasiResource($lokasi);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Lokasi $lokasi)
    {
        // $this->authorize('view', $lokasi);

        return new LokasiResource($lokasi);
    }

    /**
     * @param \App\Http\Requests\LokasiUpdateRequest $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(LokasiUpdateRequest $request, Lokasi $lokasi)
    {
        // $this->authorize('update', $lokasi);

        $validated = $request->validated();

        $lokasi->update($validated);

        return new LokasiResource($lokasi);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lokasi $lokasi)
    {
        // $this->authorize('delete', $lokasi);

        $lokasi->delete();

        return response()->noContent();
    }
}