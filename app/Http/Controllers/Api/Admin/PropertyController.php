<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePropertyRequest;
use App\Http\Requests\Admin\UpdatePropertyRequest;
use App\Models\Property;
use Illuminate\Http\JsonResponse;

class PropertyController extends Controller
{
    // 1. List all properties (including drafts) for the Admin table
    public function index(): JsonResponse
    {
        $properties = Property::latest()->get();
        return response()->json(['data' => $properties]);
    }

    // 2. Create a new property
    public function store(StorePropertyRequest $request): JsonResponse
    {
        $property = Property::create($request->validated());

        return response()->json([
            'message' => 'Property created successfully.',
            'data' => $property
        ], 201);
    }

    // 3. View a single property for the Admin Edit form
    public function show(Property $property): JsonResponse
    {
        return response()->json(['data' => $property->load('gallery')]);
    }

    // 4. Update an existing property
    public function update(UpdatePropertyRequest $request, Property $property): JsonResponse
    {
        $property->update($request->validated());

        return response()->json([
            'message' => 'Property updated successfully.',
            'data' => $property
        ]);
    }

    // 5. Delete a property
    public function destroy(Property $property): JsonResponse
    {
        $property->delete();

        return response()->json([
            'message' => 'Property deleted successfully.'
        ]);
    }
}
