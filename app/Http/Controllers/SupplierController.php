<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;

class SupplierController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Supplier::class);

        $search = $request->get('search', '');

        $suppliers = Supplier::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.suppliers.index', compact('suppliers', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Supplier::class);

        $kategoris = Kategori::pluck('kategori', 'id');

        return view('app.suppliers.create', compact('kategoris'));
    }

    /**
     * @param \App\Http\Requests\SupplierStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierStoreRequest $request)
    {
        $this->authorize('create', Supplier::class);

        $validated = $request->validated();

        $supplier = Supplier::create($validated);

        return redirect()
            ->route('suppliers.edit', $supplier)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Supplier $supplier)
    {
        $this->authorize('view', $supplier);

        return view('app.suppliers.show', compact('supplier'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Supplier $supplier)
    {
        $this->authorize('update', $supplier);

        $kategoris = Kategori::pluck('kategori', 'id');

        return view('app.suppliers.edit', compact('supplier', 'kategoris'));
    }

    /**
     * @param \App\Http\Requests\SupplierUpdateRequest $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        $this->authorize('update', $supplier);

        $validated = $request->validated();

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.edit', $supplier)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Supplier $supplier)
    {
        $this->authorize('delete', $supplier);

        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
