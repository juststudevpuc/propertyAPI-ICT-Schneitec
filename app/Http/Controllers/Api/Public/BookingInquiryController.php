<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreBookingInquiryRequest;
use App\Models\BookingInquiry;
use Illuminate\Http\JsonResponse;

class BookingInquiryController extends Controller
{
    public function store(StoreBookingInquiryRequest $request): JsonResponse
    {
        BookingInquiry::create($request->validated());

        return response()->json([
            'message' => 'Inquiry received. Our team will contact you shortly.'
        ], 201);
    }
}
