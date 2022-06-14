<?php

namespace App\Http\Controllers\Api;

use App\Models\Merek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MerekResource;
use App\Http\Resources\MerekCollection;
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
        // $this->authorize('view-any', Merek::class);

        $search = $request->get('search', '');

        $mereks = Merek::search($search)
            ->latest()
            ->paginate();

        return new MerekCollection($mereks);
    }

    /**
     * @param \App\Http\Requests\MerekStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerekStoreRequest $request)
    {
        // $this->authorize('create', Merek::class);

        $validated = $request->validated();

        $merek = Merek::create($validated);

        return new MerekResource($merek);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Merek $merek)
    {
        // $this->authorize('view', $merek);

        return new MerekResource($merek);
    }

    /**
     * @param \App\Http\Requests\MerekUpdateRequest $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function update(MerekUpdateRequest $request, Merek $merek)
    {
        // $this->authorize('update', $merek);

        $validated = $request->validated();

        $merek->update($validated);

        return new MerekResource($merek);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Merek $merek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Merek $merek)
    {
        // $this->authorize('delete', $merek);

        $merek->delete();

        return response()->noContent();
    }
}