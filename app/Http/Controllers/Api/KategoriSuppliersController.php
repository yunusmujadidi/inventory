<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierCollection;

class KategoriSuppliersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Kategori $kategori)
    {
        // $this->authorize('view', $kategori);

        $search = $request->get('search', '');

        $suppliers = $kategori
            ->suppliers()
            ->search($search)
            ->latest()
            ->paginate();

        return new SupplierCollection($suppliers);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kategori $kategori)
    {
        // $this->authorize('create', Supplier::class);

        $validated = $request->validate([
            'nama_supplier' => ['required', 'max:255', 'string'],
            'alamat' => ['required', 'max:255'],
            'telp' => ['required'],
        ]);

        $supplier = $kategori->suppliers()->create($validated);

        return new SupplierResource($supplier);
    }
}