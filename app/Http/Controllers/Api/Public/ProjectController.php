<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('gallery')
            ->where('is_published', true)
            ->latest()
            ->get();

        return ProjectResource::collection($projects);
    }

    public function show($id)
    {
        $project = Project::with('gallery')
            ->where('is_published', true)
            ->where(function ($query) use ($id) {
                $query->where('slug', $id);
                if (is_numeric($id)) {
                    $query->orWhere('id', (int) $id);
                }
            })
            ->firstOrFail();

        return new ProjectResource($project);
    }
}
