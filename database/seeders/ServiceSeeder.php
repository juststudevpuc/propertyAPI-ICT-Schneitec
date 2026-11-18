<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        /* ─── 1. Default Hero & Banner Settings (Non-Destructive) ─── */
        $defaultSettings = [
            'services_hero_eyebrow'      => 'Asset Stewardship & Hospitality',
            'services_hero_title'        => "Preserving Value,\nElevating Living",
            'services_hero_description'  => 'At GREYON, asset management extends beyond handover. Through dedicated brokerage, leasing advisory, and precision home health audits, we preserve the architectural integrity and long-term yield of every residence while ensuring an effortless ownership experience.',
            'services_hero_image'        => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=2400&q=85',
            'services_care_banner_image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=2400&q=85',
            'services_tags'              => 'Rental, Cleaning, Laundry, Decoration, Resales',
        ];

        foreach ($defaultSettings as $key => $value) {
            SiteSetting::firstOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        /* ─── 2. Architectural Home Care Slides (care_slide) ────────── */
        $careSlides = [
            [
                'sort_order'    => 1,
                'tab_name'      => '01 / Home Check-Up',
                'title'         => 'Precision Home Seeder',
                'subtitle'      => 'Structural Assurance & Performance',
                'intro'         => 'Complimentary bi-annual technical audits conducted across all primary building envelopes during the active warranty tenure.',
                'bullets'       => [
                    'Comprehensive audit of 7 critical domains: Fenestration, interior surfaces, acoustic barriers, MEP installations, fire safety systems, and automated valves.',
                    'Conducted bi-annually by licensed architectural engineers and senior technicians.',
                    'Includes digital diagnostic reports with preventative maintenance recommendations.',
                ],
                'footnote'      => '*Terms, inspection schedules, and warranty scope apply per residential agreement.',
                'image_url'     => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=2000&q=85',
                'contact_desk'  => 'Engineering & Technical Audit Desk',
                'contact_phone' => '+855 (0) 23 901 888',
                'contact_email' => 'Seeder@greyon.com',
                'contact_hours' => 'Mon – Sat · 08:30 – 18:00',
                'is_published'  => true,
            ],
            [
                'sort_order'    => 2,
                'tab_name'      => '02 / Healthy Home Event',
                'title'         => 'Wellness & Habitat Servicing',
                'subtitle'      => 'Preventative Longevity Care',
                'intro'         => 'Specialized maintenance protocols for engineered finishes, acoustic assemblies, and integrated climate systems.',
                'bullets'       => [
                    'Certified technicians oversee calibration of concealed air filtration and microclimate systems.',
                    'Tactile surface treatments for natural timber and imported natural stone slabs.',
                    'Flexible annual concierge scheduling tailored to resident lifestyle preferences.',
                ],
                'footnote'      => '*Terms, inspection schedules, and warranty scope apply per residential agreement.',
                'image_url'     => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=2000&q=85',
                'contact_desk'  => 'Habitat Stewardship & Concierge Desk',
                'contact_phone' => '+855 (0) 23 901 899',
                'contact_email' => 'stewardship@greyon.com',
                'contact_hours' => 'Daily · 08:00 – 20:00',
                'is_published'  => true,
            ],
        ];

        foreach ($careSlides as $slide) {
            Service::updateOrCreate(
                [
                    'section_type' => Service::TYPE_CARE_SLIDE,
                    'sort_order'   => $slide['sort_order'],
                ],
                $slide
            );
        }

        /* ─── 3. Brokerage Lifecycle Protocols (brokerage_protocol) ─── */
        $brokerageProtocols = [
            [
                'sort_order'   => 1,
                'tab_name'     => 'PROTOCOL 01 // SUBSIDIARY',
                'title'        => 'Asset Management',
                'subtitle'     => 'Protecting Interests, Sustaining Yield',
                'intro'        => 'Every residence is a legacy investment. Our role is to safeguard capital through proactive tenancy curation, transparent financial reporting, and comprehensive resale positioning to preserve long-term asset value.',
                'is_published' => true,
            ],
            [
                'sort_order'   => 2,
                'tab_name'     => 'PROTOCOL 02 // LEASING',
                'title'        => 'Private Leasing',
                'subtitle'     => 'Seamless Tenancies, Curated Occupants',
                'intro'        => 'From multi-channel tenant screening to rent collection, contract administration, and turnover housekeeping, our hospitality desk ensures your residence remains pristine and consistently yielding without administrative friction.',
                'is_published' => true,
            ],
            [
                'sort_order'   => 3,
                'tab_name'     => 'PROTOCOL 03 // BROKERAGE',
                'title'        => 'Bespoke Resales',
                'subtitle'     => 'Private Network, Premium Realization',
                'intro'        => 'Leveraging an established network of ultra-high-net-worth investors and discreet private brokerage channels, we market signature residences with confidentiality, achieving optimal valuation and effortless title transfers.',
                'is_published' => true,
            ],
            [
                'sort_order'   => 4,
                'tab_name'     => 'PROTOCOL 04 // STEWARDSHIP',
                'title'        => 'Residence Care',
                'subtitle'     => 'Enduring Condition & Security',
                'intro'        => 'Our dedicated engineering desk coordinates scheduled structural check-ups, appliance diagnostics, and preventative servicing to ensure your habitat operates at peak acoustic and functional performance.',
                'is_published' => true,
            ],
        ];

        foreach ($brokerageProtocols as $protocol) {
            Service::updateOrCreate(
                [
                    'section_type' => Service::TYPE_BROKERAGE_PROTOCOL,
                    'sort_order'   => $protocol['sort_order'],
                ],
                $protocol
            );
        }
    }
}
