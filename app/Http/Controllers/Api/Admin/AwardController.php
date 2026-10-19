<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AwardController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(['data' => Award::orderBy('display_order')->get()]);
    }

    public function store(Request $request): JsonResponse {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:4',
            'icon_name' => 'nullable|string|max:50',
            'award_type' => 'string|max:50',
            'display_order' => 'integer',
        ]);
        return response()->json(['data' => Award::create($data)], 201);
    }

    public function show(Award $award): JsonResponse {
        return response()->json(['data' => $award]);
    }

    public function update(Request $request, Award $award): JsonResponse {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:4',
            'icon_name' => 'nullable|string|max:50',
            'award_type' => 'string|max:50',
            'display_order' => 'integer',
        ]);
        $award->update($data);
        return response()->json(['data' => $award]);
    }

    public function destroy(Award $award): JsonResponse {
        $award->delete();
        return response()->json(['message' => 'Award deleted']);
    }
}
