<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\MediaAssetController;
use App\Http\Controllers\Api\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Api\Public\PropertyController;
use App\Http\Controllers\Api\Public\ProjectController;
use App\Http\Controllers\Api\Public\NewsArticleController;
use App\Http\Controllers\Api\Public\GuestFeedbackController;  // <-- Add this
use App\Http\Controllers\Api\Public\BookingInquiryController; // <-- Add this
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // PUBLIC ROUTES (No token required)
    Route::get('/properties', [PropertyController::class, 'index']);
    Route::get('/properties/{id}', [PropertyController::class, 'show']);

    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);

    Route::get('/news', [NewsArticleController::class, 'index']);
    Route::get('/news/{id}', [NewsArticleController::class, 'show']);

    // PUBLIC FORM SUBMISSIONS
    Route::post('/feedback', [GuestFeedbackController::class, 'store']);             // <-- Add this
    Route::post('/inquiries/booking', [BookingInquiryController::class, 'store']);   // <-- Add this

    // ADMIN ROUTES
    Route::post('/admin/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/media', [MediaAssetController::class, 'index']);
        Route::post('/media/upload', [MediaAssetController::class, 'store']);
        Route::put('/media/{mediaAsset}', [MediaAssetController::class, 'update']);
        Route::delete('/media/{mediaAsset}', [MediaAssetController::class, 'destroy']);

        Route::apiResource('properties', AdminPropertyController::class);

        Route::apiResource('projects', \App\Http\Controllers\Api\Admin\ProjectController::class);
        Route::apiResource('news', \App\Http\Controllers\Api\Admin\NewsArticleController::class);
        Route::get('inbox/inquiries', [\App\Http\Controllers\Api\Admin\InboxController::class, 'inquiries']);
        Route::get('inbox/feedback', [\App\Http\Controllers\Api\Admin\InboxController::class, 'feedback']);
    });
});
