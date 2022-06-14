<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Http\Resources\KategoriCollection;
use App\Http\Requests\KategoriStoreRequest;
use App\Http\Requests\KategoriUpdateRequest;

class KategoriController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view-any', Kategori::class);

        $search = $request->get('search', '');

        $kategoris = Kategori::search($search)
            ->latest()
            ->paginate();

        return new KategoriCollection($kategoris);
    }

    /**
     * @param \App\Http\Requests\KategoriStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriStoreRequest $request)
    {
        // $this->authorize('create', Kategori::class);

        $validated = $request->validated();

        $kategori = Kategori::create($validated);

        return new KategoriResource($kategori);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Kategori $kategori)
    {
        // $this->authorize('view', $kategori);

        return new KategoriResource($kategori);
    }

    /**
     * @param \App\Http\Requests\KategoriUpdateRequest $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriUpdateRequest $request, Kategori $kategori)
    {
        // $this->authorize('update', $kategori);

        $validated = $request->validated();

        $kategori->update($validated);

        return new KategoriResource($kategori);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kategori $kategori)
    {
        // $this->authorize('delete', $kategori);

        $kategori->delete();

        return response()->noContent();
    }
}