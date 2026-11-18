<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    /**
     * List all service items ordered by section and sort_order.
     */
    public function index(): JsonResponse
    {
        $services = Service::ordered()->get();
        return response()->json(['data' => $services]);
    }

    /**
     * Store a new care slide or brokerage protocol.
     */
    public function store(StoreServiceRequest $request): JsonResponse
    {
        $service = Service::create($request->validated());
        return response()->json([
            'message' => 'Service item created.',
            'data'    => $service,
        ], 201);
    }

    /**
     * Show a single service item.
     */
    public function show(Service $service): JsonResponse
    {
        return response()->json(['data' => $service]);
    }

    /**
     * Update an existing service item.
     */
    public function update(UpdateServiceRequest $request, Service $service): JsonResponse
    {
        $service->update($request->validated());
        return response()->json([
            'message' => 'Service item updated.',
            'data'    => $service,
        ]);
    }

    /**
     * Delete a service item permanently.
     */
    public function destroy(Service $service): JsonResponse
    {
        $service->delete();
        return response()->json(['message' => 'Service item deleted.']);
    }
}
