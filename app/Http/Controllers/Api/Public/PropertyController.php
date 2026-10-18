<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Http\Resources\PropertyResource;

class PropertyController extends Controller
{
    public function index()
    {
        // Fetch published properties with their galleries
        $properties = Property::with('gallery')
            ->where('is_published', true)
            ->get();

        return PropertyResource::collection($properties);
    }

    public function show($id)
    {
        $property = Property::with('gallery')
            ->where('is_published', true)
            ->findOrFail($id);

        return new PropertyResource($property);
    }
}
