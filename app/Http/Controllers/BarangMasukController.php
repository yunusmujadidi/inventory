<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', BarangMasuk::class);

        $search = $request->get('search', '');

        $barangMasuks = BarangMasuk::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.barang_masuks.index',
            compact('barangMasuks', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', BarangMasuk::class);

        $suppliers = Supplier::pluck('nama_supplier', 'id');
        $barangs = Barang::pluck('kode_barang', 'id');

        return view(
            'app.barang_masuks.create',
            compact('suppliers', 'barangs')
        );
    }

    /**
     * @param \App\Http\Requests\BarangMasukStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangMasukStoreRequest $request)
    {
        $this->authorize('create', BarangMasuk::class);

        $validated = $request->validated();

        $barangMasuk = BarangMasuk::create($validated);

        return redirect()
            ->route('barang-masuks.edit', $barangMasuk)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangMasuk $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BarangMasuk $barangMasuk)
    {
        $this->authorize('view', $barangMasuk);

        return view('app.barang_masuks.show', compact('barangMasuk'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangMasuk $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BarangMasuk $barangMasuk)
    {
        $this->authorize('update', $barangMasuk);

        $suppliers = Supplier::pluck('nama_supplier', 'id');
        $barangs = Barang::pluck('kode_barang', 'id');

        return view(
            'app.barang_masuks.edit',
            compact('barangMasuk', 'suppliers', 'barangs')
        );
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
        $this->authorize('update', $barangMasuk);

        $validated = $request->validated();

        $barangMasuk->update($validated);

        return redirect()
            ->route('barang-masuks.edit', $barangMasuk)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangMasuk $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BarangMasuk $barangMasuk)
    {
        $this->authorize('delete', $barangMasuk);

        $barangMasuk->delete();

        return redirect()
            ->route('barang-masuks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
