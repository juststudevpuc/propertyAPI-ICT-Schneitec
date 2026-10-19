<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\AwardController;
use App\Http\Controllers\Api\Admin\MediaAssetController;
use App\Http\Controllers\Api\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Api\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Api\Admin\NewsArticleController as AdminNewsController;
use App\Http\Controllers\Api\Admin\InboxController;
use App\Http\Controllers\Api\Admin\OfferController;
use App\Http\Controllers\Api\Admin\ExperienceController;
use App\Http\Controllers\Api\Admin\JobOpeningController;
use App\Http\Controllers\Api\Admin\TeamMemberController;
use App\Http\Controllers\Api\Public\PropertyController;
use App\Http\Controllers\Api\Public\ProjectController;
use App\Http\Controllers\Api\Public\NewsArticleController;
use App\Http\Controllers\Api\Public\GuestFeedbackController;
use App\Http\Controllers\Api\Public\BookingInquiryController;
use App\Http\Controllers\Api\Public\FrontendContentController;

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // PUBLIC ROUTES (No token required)
    Route::get('/properties', [PropertyController::class, 'index']);
    Route::get('/properties/{id}', [PropertyController::class, 'show']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::get('/news', [NewsArticleController::class, 'index']);
    Route::get('/news/{id}', [NewsArticleController::class, 'show']);

    // NEW: UNIFIED PUBLIC CONTENT ROUTES
    Route::get('/offers', [FrontendContentController::class, 'offers']);
    Route::get('/experiences', [FrontendContentController::class, 'experiences']);
    Route::get('/jobs', [FrontendContentController::class, 'jobs']);
    Route::get('/team', [FrontendContentController::class, 'team']);
    Route::get('/awards', [FrontendContentController::class, 'awards']);
    Route::get('/settings', [FrontendContentController::class, 'settings']);

    // PUBLIC FORM SUBMISSIONS
    Route::post('/feedback', [GuestFeedbackController::class, 'store']);
    Route::post('/inquiries/booking', [BookingInquiryController::class, 'store']);

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
        Route::apiResource('projects', AdminProjectController::class);
        Route::apiResource('news', AdminNewsController::class);

        // NEW: ADMIN CRUD ROUTES
        Route::apiResource('offers', OfferController::class);
        Route::apiResource('experiences', ExperienceController::class);
        Route::apiResource('jobs', JobOpeningController::class);

        Route::get('settings', [\App\Http\Controllers\Api\Admin\SiteSettingController::class, 'index']);
        Route::post('settings', [\App\Http\Controllers\Api\Admin\SiteSettingController::class, 'updateAll']);

        Route::get('inbox/inquiries', [InboxController::class, 'inquiries']);
        Route::get('inbox/feedback', [InboxController::class, 'feedback']);

        Route::apiResource('team', TeamMemberController::class);
        Route::apiResource('awards', AwardController::class);
    });
});
