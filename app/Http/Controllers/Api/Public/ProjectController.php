<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('gallery')->where('is_published', true)->get();
        return ProjectResource::collection($projects);
    }

    public function show($id)
    {
        $project = Project::with('gallery')->where('is_published', true)->findOrFail($id);
        return new ProjectResource($project);
    }
}
