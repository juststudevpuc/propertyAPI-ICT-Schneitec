<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\{Offer, Experience, JobOpening, TeamMember, Award, SiteSetting};
use Illuminate\Http\JsonResponse;

class FrontendContentController extends Controller
{
    public function offers(): JsonResponse {
        return response()->json(['data' => Offer::where('is_published', true)->orderBy('display_order')->get()]);
    }

    public function experiences(): JsonResponse {
        return response()->json(['data' => Experience::where('is_published', true)->orderBy('display_order')->get()]);
    }

    public function jobs(): JsonResponse {
        return response()->json(['data' => JobOpening::where('is_published', true)->orderBy('display_order')->get()]);
    }

    public function team(): JsonResponse {
        return response()->json(['data' => TeamMember::orderBy('display_order')->get()]);
    }

    public function awards(): JsonResponse {
        return response()->json(['data' => Award::orderBy('display_order')->get()]);
    }

    public function settings(): JsonResponse {
        // Plucks key-value pairs (e.g., {"contact_email": "hello@schneitec.com"})
        return response()->json(['data' => SiteSetting::pluck('value', 'key')]);
    }
}
