<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(['data' => Project::latest()->get()]);
    }

    public function store(StoreProjectRequest $request): JsonResponse {
        return response()->json(['message' => 'Project created.', 'data' => Project::create($request->validated())], 201);
    }

    public function show(Project $project): JsonResponse {
        return response()->json(['data' => $project->load('gallery')]);
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse {
        $project->update($request->validated());
        return response()->json(['message' => 'Project updated.', 'data' => $project]);
    }

    public function destroy(Project $project): JsonResponse {
        $project->delete();
        return response()->json(['message' => 'Project deleted.']);
    }
}
