<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreGuestFeedbackRequest;
use App\Models\GuestFeedback;
use Illuminate\Http\JsonResponse;

class GuestFeedbackController extends Controller
{
    public function store(StoreGuestFeedbackRequest $request): JsonResponse
    {
        GuestFeedback::create($request->validated());

        return response()->json([
            'message' => 'Thank you! Your feedback has been submitted successfully.'
        ], 201);
    }
}
