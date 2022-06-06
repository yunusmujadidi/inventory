<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', Lokasi::class);

        $search = $request->get('search', '');

        $lokasis = Lokasi::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.lokasis.index', compact('lokasis', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Lokasi::class);

        return view('app.lokasis.create');
    }

    /**
     * @param \App\Http\Requests\LokasiStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LokasiStoreRequest $request)
    {
        $this->authorize('create', Lokasi::class);

        $validated = $request->validated();

        $lokasi = Lokasi::create($validated);

        return redirect()
            ->route('lokasis.edit', $lokasi)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Lokasi $lokasi)
    {
        $this->authorize('view', $lokasi);

        return view('app.lokasis.show', compact('lokasi'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Lokasi $lokasi)
    {
        $this->authorize('update', $lokasi);

        return view('app.lokasis.edit', compact('lokasi'));
    }

    /**
     * @param \App\Http\Requests\LokasiUpdateRequest $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(LokasiUpdateRequest $request, Lokasi $lokasi)
    {
        $this->authorize('update', $lokasi);

        $validated = $request->validated();

        $lokasi->update($validated);

        return redirect()
            ->route('lokasis.edit', $lokasi)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lokasi $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lokasi $lokasi)
    {
        $this->authorize('delete', $lokasi);

        $lokasi->delete();

        return redirect()
            ->route('lokasis.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
