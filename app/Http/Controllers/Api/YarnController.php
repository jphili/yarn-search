<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Yarn;
use App\Services\Ravelry\RavelryApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class YarnController extends Controller
{
    protected $ravelryApiService;

    public function __construct(RavelryApiService $ravelryApiService)
    {
        $this->ravelryApiService = $ravelryApiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // https://www.ravelry.com/api#yarns_search

        // test some filters asap

        $response = $this->ravelryApiService->fetchData(
            'yarns/search.json', ''
            // ['color-family' => 'Orange',
            //     'weight' => 'dk',
            //     'fiber-content' => 'merino',
            //     'handspun' => 'no',
            //     'sort' => 'favorited']
        );

        return $response;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Yarn $yarn): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Yarn $yarn): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Yarn $yarn): JsonResponse
    {
        //
    }
}
