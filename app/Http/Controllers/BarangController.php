<?php

namespace App\Http\Controllers;

use App\Models\Merek;
use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', Barang::class);

        $search = $request->get('search', '');

        $barangs = Barang::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.barangs.index', compact('barangs', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Barang::class);

        $mereks = Merek::pluck('merek', 'id');
        $kategoris = Kategori::pluck('kategori', 'id');
        $lokasis = Lokasi::pluck('lokasi', 'id');

        return view(
            'app.barangs.create',
            compact('mereks', 'kategoris', 'lokasis')
        );
    }

    /**
     * @param \App\Http\Requests\BarangStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangStoreRequest $request)
    {
        $this->authorize('create', Barang::class);

        $validated = $request->validated();

        $barang = Barang::create($validated);

        return redirect()
            ->route('barangs.edit', $barang)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Barang $barang)
    {
        $this->authorize('view', $barang);

        return view('app.barangs.show', compact('barang'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Barang $barang)
    {
        $this->authorize('update', $barang);

        $mereks = Merek::pluck('merek', 'id');
        $kategoris = Kategori::pluck('kategori', 'id');
        $lokasis = Lokasi::pluck('lokasi', 'id');

        return view(
            'app.barangs.edit',
            compact('barang', 'mereks', 'kategoris', 'lokasis')
        );
    }

    /**
     * @param \App\Http\Requests\BarangUpdateRequest $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function update(BarangUpdateRequest $request, Barang $barang)
    {
        $this->authorize('update', $barang);

        $validated = $request->validated();

        $barang->update($validated);

        return redirect()
            ->route('barangs.edit', $barang)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Barang $barang)
    {
        $this->authorize('delete', $barang);

        $barang->delete();

        return redirect()
            ->route('barangs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
