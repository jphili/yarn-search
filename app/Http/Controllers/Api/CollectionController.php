<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionCollection;
use App\Http\Resources\CollectionResource;
use App\Models\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $collections = Collection::where('user_id', auth()->user()->id)->paginate();
        if ($collections->count() > 0) {
            return (new CollectionCollection($collections))->response();
        } else {
            return response()->json([
                'message' => 'No collections created yet.',
            ], 200);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $collection = new Collection;
        $collection->collection_name = $request->name;
        $collection->user_id = $request->user()->id;
        $collection->save();

        return (new CollectionResource($collection))->response();
        // return response()->json([
        //     "message" => "Collection $collection->name created."
        // ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection): JsonResponse
    {
        if (Collection::where([
            ['user_id', '=', auth()->user()->id],
            ['id', '=', $collection->id]])
            ->exists()) {
            return (new CollectionResource($collection))->response();
            //return response()->json($collection);
        } else {
            return response()->json([
                'message' => 'Collection not found.',
            ], 404);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {

        if (Collection::where([
            ['user_id', '=', $request->user()->id],
            ['id', '=', $collection->id]])
            ->exists()) {
            $collection = Collection::find($collection->id);
            $collection->collection_name = is_null($request->name) ? $collection->name : $request->name;
            $collection->save();

            return (new CollectionResource($collection))->response();
            // return response()->json([
            //     "message" => "Collection updated."
            // ], 204);
        } else {
            return response()->json([
                'message' => 'Collection not found.',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection): JsonResponse
    {
        if (Collection::where([
            ['user_id', '=', auth()->user()->id],
            ['id', '=', $collection->id]])
            ->exists()) {
            $collection = Collection::find($collection->id);
            $collection->delete();

            return response()->json([
                'message' => 'Collection deleted.',
            ], 202);
        } else {
            return response()->json([
                'message' => 'Collection not found.',
            ], 404);

        }
    }
}
