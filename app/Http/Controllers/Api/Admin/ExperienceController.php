<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(['data' => Experience::orderBy('display_order')->get()]);
    }

    public function store(Request $request): JsonResponse {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|string|url',
            'cta_link' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'display_order' => 'integer',
        ]);
        return response()->json(['data' => Experience::create($data)], 201);
    }

    public function show(Experience $experience): JsonResponse {
        return response()->json(['data' => $experience]);
    }

    public function update(Request $request, Experience $experience): JsonResponse {
        $data = $request->validate([
            'category' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image_url' => 'nullable|string|url',
            'cta_link' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'display_order' => 'integer',
        ]);
        $experience->update($data);
        return response()->json(['data' => $experience]);
    }

    public function destroy(Experience $experience): JsonResponse {
        $experience->delete();
        return response()->json(['message' => 'Experience deleted']);
    }
}
