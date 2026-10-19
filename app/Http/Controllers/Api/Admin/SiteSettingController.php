<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SiteSettingController extends Controller
{
    public function index(): JsonResponse
    {
        // Returns settings as a simple key-value object
        return response()->json([
            'data' => SiteSetting::pluck('value', 'key')
        ]);
    }

    public function updateAll(Request $request): JsonResponse
    {
        $data = $request->validate([
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json(['message' => 'Settings updated successfully']);
    }
}
