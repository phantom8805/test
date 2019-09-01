<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Requests\SearchRequest;
use App\Resources\ContactResource;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function search(SearchRequest $request, SearchService $service)
    {
        try {
            $contacts = $service->search($request);
            return ContactResource::collection($contacts);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage(), 400]);
        }
    }
}
