<?php

namespace App\Services\Ravelry;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class RavelryApiService
{
    public function __construct(
        protected string $username,
        protected string $password,
        protected string $apiUrl
    ) {
    }

    public function fetchData($endpoint, $queryParameters): JsonResponse
    {
        $params = json_encode($queryParameters);
        $cacheKey = "api:$endpoint:$params";

        // if (Redis::exists($cacheKey)) {
        //     return Redis::get($cacheKey);
        // }

        // queryParameters = ['key' => 'value']

        $response = Http::withBasicAuth($this->username, $this->password)
            ->withHeaders([
                'Accept' => 'application/json',
            ])->get(
                $this->apiUrl.$endpoint//, $queryParameters
            );

        if ($response->successful()) {
            $this->cacheData($response->getBody()->getContents(), $cacheKey);

            return response()->json([
                json_decode($response->getBody())->yarns,
            ]);
        } else {
            return response()->json([
                'message' => 'Something went wrong.',
                'notes' => $response,
            ], 500);
        }
    }

    public function cacheData($data, $cacheKey)
    {
        Redis::setex($cacheKey, 3600, $data);
    }
}
