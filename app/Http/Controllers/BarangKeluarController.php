<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', BarangKeluar::class);

        $search = $request->get('search', '');

        $barangKeluars = BarangKeluar::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.barang_keluars.index',
            compact('barangKeluars', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', BarangKeluar::class);

        $lokasis = Lokasi::pluck('lokasi', 'id');
        $barangs = Barang::pluck('kode_barang', 'id');

        return view('app.barang_keluars.create', compact('lokasis', 'barangs'));
    }

    /**
     * @param \App\Http\Requests\BarangKeluarStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangKeluarStoreRequest $request)
    {
        $this->authorize('create', BarangKeluar::class);

        $validated = $request->validated();

        $barangKeluar = BarangKeluar::create($validated);

        return redirect()
            ->route('barang-keluars.edit', $barangKeluar)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangKeluar $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BarangKeluar $barangKeluar)
    {
        $this->authorize('view', $barangKeluar);

        return view('app.barang_keluars.show', compact('barangKeluar'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangKeluar $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BarangKeluar $barangKeluar)
    {
        $this->authorize('update', $barangKeluar);

        $lokasis = Lokasi::pluck('lokasi', 'id');
        $barangs = Barang::pluck('kode_barang', 'id');

        return view(
            'app.barang_keluars.edit',
            compact('barangKeluar', 'lokasis', 'barangs')
        );
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
        $this->authorize('update', $barangKeluar);

        $validated = $request->validated();

        $barangKeluar->update($validated);

        return redirect()
            ->route('barang-keluars.edit', $barangKeluar)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BarangKeluar $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BarangKeluar $barangKeluar)
    {
        $this->authorize('delete', $barangKeluar);

        $barangKeluar->delete();

        return redirect()
            ->route('barang-keluars.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
