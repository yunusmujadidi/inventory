<?php

namespace App\Http\Controllers;

use App\Models\Merek;
use Illuminate\Http\Request;
use App\Http\Requests\MerekStoreRequest;
use App\Http\Requests\MerekUpdateRequest;

class MerekController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Merek::class);

        $search = $request->get('search', '');

        $mereks = Merek::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.mereks.index', compact('mereks', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Merek::class);

        return view('app.mereks.create');
    }

    /**
     * @param \App\Http\Requests\MerekStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerekStoreRequest $request)
    {
        $this->authorize('create', Merek::class);

        $validated = $request->validated();

        $merek = Merek::create($validated);

        return redirect()
            ->route('mereks.edit', $merek)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Merek $merek)
    {
        $this->authorize('view', $merek);

        return view('app.mereks.show', compact('merek'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Merek $merek)
    {
        $this->authorize('update', $merek);

        return view('app.mereks.edit', compact('merek'));
    }

    /**
     * @param \App\Http\Requests\MerekUpdateRequest $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function update(MerekUpdateRequest $request, Merek $merek)
    {
        $this->authorize('update', $merek);

        $validated = $request->validated();

        $merek->update($validated);

        return redirect()
            ->route('mereks.edit', $merek)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Merek $merek)
    {
        $this->authorize('delete', $merek);

        $merek->delete();

        return redirect()
            ->route('mereks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
