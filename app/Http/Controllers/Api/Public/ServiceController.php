<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    /**
     * Return published services grouped by section + page banner settings.
     */
    public function index(): JsonResponse
    {
        $careSlides = Service::published()
            ->ofSection(Service::TYPE_CARE_SLIDE)
            ->ordered()
            ->get();

        $brokerageProtocols = Service::published()
            ->ofSection(Service::TYPE_BROKERAGE_PROTOCOL)
            ->ordered()
            ->get();

        // Read optional services_* overrides from site_settings table
        $settings = SiteSetting::where('key', 'like', 'services_%')
            ->pluck('value', 'key');

        $rawTags = $settings->get('services_tags');
        $tags = $rawTags
            ? array_values(array_filter(array_map('trim', explode(',', $rawTags))))
            : ['Rental', 'Cleaning', 'Laundry', 'Decoration', 'Resales'];

        return response()->json([
            'data' => [
                'page_settings' => [
                    'hero_eyebrow'      => $settings->get('services_hero_eyebrow', 'Asset Stewardship & Hospitality'),
                    'hero_title'        => $settings->get('services_hero_title', "Preserving Value,\nElevating Living"),
                    'hero_description'  => $settings->get('services_hero_description', 'At GREYON, asset management extends beyond handover. Through dedicated brokerage, leasing advisory, and precision home health audits, we preserve the architectural integrity and long-term yield of every residence while ensuring an effortless ownership experience.'),
                    'hero_image'        => $settings->get('services_hero_image', 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=2400&q=85'),
                    'care_banner_image' => $settings->get('services_care_banner_image', 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=2400&q=85'),
                    'tags'              => $tags,
                ],
                'brokerage_protocols' => ServiceResource::collection($brokerageProtocols),
                'care_slides'         => ServiceResource::collection($careSlides),
            ],
        ]);
    }
}
