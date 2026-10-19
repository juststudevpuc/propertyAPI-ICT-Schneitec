<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OfferController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(['data' => Offer::orderBy('display_order')->get()]);
    }

    public function store(Request $request): JsonResponse {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'validity' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|string|url',
            'cta_link' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'display_order' => 'integer',
        ]);
        return response()->json(['data' => Offer::create($data)], 201);
    }

    public function show(Offer $offer): JsonResponse {
        return response()->json(['data' => $offer]);
    }

    public function update(Request $request, Offer $offer): JsonResponse {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'validity' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image_url' => 'nullable|string|url',
            'cta_link' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'display_order' => 'integer',
        ]);
        $offer->update($data);
        return response()->json(['data' => $offer]);
    }

    public function destroy(Offer $offer): JsonResponse {
        $offer->delete();
        return response()->json(['message' => 'Offer deleted']);
    }
}
