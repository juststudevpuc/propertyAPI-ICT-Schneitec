<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingInquiry;
use App\Models\GuestFeedback;
use Illuminate\Http\JsonResponse;
// (This handles viewing your form submissions in the admin panel without needing full CRUD files)
class InboxController extends Controller
{
    public function inquiries(): JsonResponse {
        return response()->json(['data' => BookingInquiry::with('property')->latest()->get()]);
    }

    public function feedback(): JsonResponse {
        return response()->json(['data' => GuestFeedback::latest()->get()]);
    }
}
