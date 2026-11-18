<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            /* ─── 1. Detached House — Chroy Changvar, Phnom Penh ──────── */
            [
                'title'           => 'CIRA Residences Phnom Penh',
                'slug'            => 'cira-residences',
                'category'        => 'Detached House',
                'tagline'         => 'Private Riverfront Villas — Chroy Changvar, Phnom Penh',
                'starting_price'  => '$2,850,000*',
                'cover_image'     => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=2000&q=85',
                'video_url'       => '/Blueprint.mp4',
                'overview'        => 'Conceived as a sanctuary of understated grandeur near the Mekong and Tonle Sap confluence in Chroy Changvar, CIRA Residences redefines super luxury living in Phnom Penh. Monolithic stone forms and expansive glazed pavilions blur the boundaries between tropical architectural mastery and verdant private landscape.',
                'design_approach' => 'Each bespoke residence is calibrated for Cambodia’s tropical climate—featuring deep cantilevered eaves, cross-ventilated double-volume salons, imported travertine, and acoustic-insulated envelopes designed for multi-generational intimacy.',
                'key_stats'       => [
                    ['value' => '9', 'label' => 'Private Enclave Villas'],
                    ['value' => '450 - 680', 'label' => 'Sq.m Land Area'],
                    ['value' => '733 - 1,223', 'label' => 'Sq.m Usable Area'],
                ],
                'house_types'     => [
                    [
                        'name'     => 'Serein',
                        'subtitle' => 'The Grand Riverfront Estate',
                        'image'    => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1800&q=85',
                        'specs'    => [
                            'landArea'   => '680 sq.m.',
                            'usableArea' => '1,223 sq.m.',
                            'bedroom'    => '5 Bedrooms',
                            'bathroom'   => '6 Bathrooms',
                            'powderRoom' => '2 Rooms',
                            'parking'    => '6 Bays',
                        ],
                    ],
                    [
                        'name'     => 'Elayne',
                        'subtitle' => 'The Signature Courtyard Villa',
                        'image'    => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1800&q=85',
                        'specs'    => [
                            'landArea'   => '520 sq.m.',
                            'usableArea' => '895 sq.m.',
                            'bedroom'    => '4 Bedrooms',
                            'bathroom'   => '5 Bathrooms',
                            'powderRoom' => '1 Room',
                            'parking'    => '4 Bays',
                        ],
                    ],
                    [
                        'name'     => 'Azure',
                        'subtitle' => 'The Pavilion Villa',
                        'image'    => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1800&q=85',
                        'specs'    => [
                            'landArea'   => '480 sq.m.',
                            'usableArea' => '810 sq.m.',
                            'bedroom'    => '4 Bedrooms',
                            'bathroom'   => '5 Bathrooms',
                            'powderRoom' => '1 Room',
                            'parking'    => '4 Bays',
                        ],
                    ],
                    [
                        'name'     => 'Soleil',
                        'subtitle' => 'The Garden Villa',
                        'image'    => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1800&q=85',
                        'specs'    => [
                            'landArea'   => '450 sq.m.',
                            'usableArea' => '733 sq.m.',
                            'bedroom'    => '4 Bedrooms',
                            'bathroom'   => '5 Bathrooms',
                            'powderRoom' => '1 Room',
                            'parking'    => '4 Bays',
                        ],
                    ],
                ],
                'amenities'       => [
                    [
                        'name'  => 'Private 15m Saltwater Lap Pool',
                        'image' => 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?auto=format&fit=crop&w=1800&q=85',
                    ],
                    [
                        'name'  => 'Riverfront BBQ & Sunset Terrace',
                        'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1800&q=85',
                    ],
                    [
                        'name'  => 'Elixir Private Tasting Lounge',
                        'image' => 'https://images.unsplash.com/photo-1544427920-c49ccfb85579?auto=format&fit=crop&w=1800&q=85',
                    ],
                    [
                        'name'  => 'Multi-Generational Family Salon',
                        'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1800&q=85',
                    ],
                ],
                'gallery_images'  => [
                    [
                        'url'     => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1800&q=85',
                        'caption' => 'Primary Courtyard Elevation — Chroy Changvar Enclave',
                    ],
                    [
                        'url'     => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1800&q=85',
                        'caption' => 'Evening Pavilion & Reflection Pool Perspective',
                    ],
                    [
                        'url'     => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1800&q=85',
                        'caption' => 'Double-Volume Living Salon with Natural Limestone',
                    ],
                ],
                'progress_text'    => 'Structural completion and private courtyard landscaping finalized in Chroy Changvar',
                'progress_percent' => 100,
                'audit_label'      => 'Certified for Handover & Occupancy',
                'is_published'     => true,
            ],

            /* ─── 2. Condominium — Boeung Keng Kang 1 (BKK1), Phnom Penh ── */
            [
                'title'           => 'The Aurelia BKK1',
                'slug'            => 'the-aurelia-bkk1',
                'category'        => 'Condominium',
                'tagline'         => 'Bespoke Sky Residences — Boeung Keng Kang 1, Phnom Penh',
                'starting_price'  => '$1,450,000*',
                'cover_image'     => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=2000&q=85',
                'video_url'       => null,
                'overview'        => 'Rising above the diplomatic district of Boeung Keng Kang 1 in central Phnom Penh, The Aurelia BKK1 offers single-floor private residences engineered for acoustic stillness and panoramic views across the capital skyline.',
                'design_approach' => 'Every residence features private lift lobbies, floor-to-ceiling low-iron solar glazing tailored for equatorial sunlight, and natural stone surfaces curated for effortless urban stewardship.',
                'key_stats'       => [
                    ['value' => '24', 'label' => 'Sky Residences'],
                    ['value' => '340 - 620', 'label' => 'Sq.m Usable Area'],
                    ['value' => '3.6 m', 'label' => 'Clear Ceiling Height'],
                ],
                'house_types'     => [
                    [
                        'name'     => 'Aurelia Simplex',
                        'subtitle' => 'Half-Floor Diplomatic Suite',
                        'image'    => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1800&q=85',
                        'specs'    => [
                            'landArea'   => 'Hard Title (Strata)',
                            'usableArea' => '340 sq.m.',
                            'bedroom'    => '3 Bedrooms',
                            'bathroom'   => '4 Bathrooms',
                            'powderRoom' => '1 Room',
                            'parking'    => '3 Bays',
                        ],
                    ],
                    [
                        'name'     => 'Aurelia Penthouse',
                        'subtitle' => 'Full-Floor Crown Residence',
                        'image'    => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1800&q=85',
                        'specs'    => [
                            'landArea'   => 'Hard Title (Strata)',
                            'usableArea' => '620 sq.m.',
                            'bedroom'    => '4 Bedrooms',
                            'bathroom'   => '5 Bathrooms',
                            'powderRoom' => '2 Rooms',
                            'parking'    => '5 Bays',
                        ],
                    ],
                ],
                'amenities'       => [
                    [
                        'name'  => 'Skyline Infinity Lap Pool',
                        'image' => 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?auto=format&fit=crop&w=1800&q=85',
                    ],
                    [
                        'name'  => 'Private Residents Library & Lounge',
                        'image' => 'https://images.unsplash.com/photo-1544427920-c49ccfb85579?auto=format&fit=crop&w=1800&q=85',
                    ],
                ],
                'gallery_images'  => [
                    [
                        'url'     => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1800&q=85',
                        'caption' => 'Panoramic Living Gallery Overlooking Central Phnom Penh',
                    ],
                    [
                        'url'     => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1800&q=85',
                        'caption' => 'Formal Dining & Private Lounge Suite',
                    ],
                ],
                'progress_text'    => 'Architectural facade glazing and interior stone fit-out underway in BKK1',
                'progress_percent' => 85,
                'audit_label'      => 'Q4 Structural & MEP Audit Passed',
                'is_published'     => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }
    }
}
