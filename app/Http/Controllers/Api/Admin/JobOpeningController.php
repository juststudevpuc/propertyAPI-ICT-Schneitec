<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JobOpeningController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(['data' => JobOpening::orderBy('display_order')->get()]);
    }

    public function store(Request $request): JsonResponse {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'apply_link' => 'nullable|string|url',
            'is_published' => 'boolean',
            'display_order' => 'integer',
        ]);
        return response()->json(['data' => JobOpening::create($data)], 201);
    }

    public function show(JobOpening $jobOpening): JsonResponse {
        return response()->json(['data' => $jobOpening]);
    }

    public function update(Request $request, JobOpening $jobOpening): JsonResponse {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'department' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
            'apply_link' => 'nullable|string|url',
            'is_published' => 'boolean',
            'display_order' => 'integer',
        ]);
        $jobOpening->update($data);
        return response()->json(['data' => $jobOpening]);
    }

    public function destroy(JobOpening $jobOpening): JsonResponse {
        $jobOpening->delete();
        return response()->json(['message' => 'Job opening deleted']);
    }
}
