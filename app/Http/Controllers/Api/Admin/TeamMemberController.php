<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TeamMemberController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(['data' => TeamMember::orderBy('display_order')->get()]);
    }

    public function store(Request $request): JsonResponse {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image_url' => 'nullable|url',
            'display_order' => 'integer',
        ]);
        return response()->json(['data' => TeamMember::create($data)], 201);
    }

    public function show(TeamMember $teamMember): JsonResponse {
        return response()->json(['data' => $teamMember]);
    }

    public function update(Request $request, TeamMember $teamMember): JsonResponse {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'role' => 'sometimes|required|string|max:255',
            'image_url' => 'nullable|url',
            'display_order' => 'integer',
        ]);
        $teamMember->update($data);
        return response()->json(['data' => $teamMember]);
    }

    public function destroy(TeamMember $teamMember): JsonResponse {
        $teamMember->delete();
        return response()->json(['message' => 'Team member deleted']);
    }
}
