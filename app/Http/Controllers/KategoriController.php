<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', Kategori::class);

        $search = $request->get('search', '');

        $kategoris = Kategori::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.kategoris.index', compact('kategoris', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Kategori::class);

        return view('app.kategoris.create');
    }

    /**
     * @param \App\Http\Requests\KategoriStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriStoreRequest $request)
    {
        $this->authorize('create', Kategori::class);

        $validated = $request->validated();

        $kategori = Kategori::create($validated);

        return redirect()
            ->route('kategoris.edit', $kategori)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Kategori $kategori)
    {
        $this->authorize('view', $kategori);

        return view('app.kategoris.show', compact('kategori'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Kategori $kategori)
    {
        $this->authorize('update', $kategori);

        return view('app.kategoris.edit', compact('kategori'));
    }

    /**
     * @param \App\Http\Requests\KategoriUpdateRequest $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriUpdateRequest $request, Kategori $kategori)
    {
        $this->authorize('update', $kategori);

        $validated = $request->validated();

        $kategori->update($validated);

        return redirect()
            ->route('kategoris.edit', $kategori)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kategori $kategori)
    {
        $this->authorize('delete', $kategori);

        $kategori->delete();

        return redirect()
            ->route('kategoris.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
