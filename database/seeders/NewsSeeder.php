<?php

namespace Database\Seeders;

use App\Models\NewsArticle;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title'         => 'Caring for Our Phnom Penh Community Beyond the Handover',
                'slug'          => 'caring-for-our-community-beyond-the-handover',
                'category'      => 'CSR',
                'date_string'   => 'NOVEMBER 15, 2026',
                'image_url'     => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1800&q=85',
                'image_caption' => 'Architectural Stewardship & Engineering Audit Desk — Phnom Penh',
                'excerpt'       => 'How our Phnom Penh engineering and asset stewardship teams partner with homeowners to sustain architectural longevity and neighborhood wellbeing long after handover.',
                'content'       => "True architectural stewardship begins the day keys are placed in a resident's hand. Across every GREYON enclave in Phnom Penh, our dedicated engineering and hospitality desks conduct scheduled preventative audits to preserve structural integrity, acoustic calm, and landscape vitality.\n\n> Architecture is not a static monument; it is a living habitat that rewards disciplined care across generations.\n\nThrough our bi-annual Home Check-Up protocol, licensed engineers inspect primary building envelopes ahead of Cambodia’s monsoon season, calibrate concealed climate systems, and maintain natural stone surfaces—ensuring each residence performs at its original design benchmark.",
                'sub_images'    => [
                    [
                        'url'     => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1400&q=85',
                        'caption' => 'Evening courtyard lighting calibration and tropical landscape care in Chroy Changvar.',
                    ],
                    [
                        'url'     => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1400&q=85',
                        'caption' => 'Interior natural stone and acoustic envelope diagnostic inspection.',
                    ],
                ],
                'is_published'  => true,
            ],
            [
                'title'         => 'Tropical Modernism Along the Mekong: Inside CIRA Residences',
                'slug'          => 'tropical-modernism-along-the-mekong-cira-residences',
                'category'      => 'PROJECT',
                'date_string'   => 'OCTOBER 28, 2026',
                'image_url'     => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1800&q=85',
                'image_caption' => 'Shaded travertine pavilion and reflection courtyard in Chroy Changvar, Phnom Penh.',
                'excerpt'       => 'An architectural study of passive cooling, natural light, and multi-generational privacy across our nine-villa riverfront enclave in Phnom Penh.',
                'content'       => "Designed around inward-looking landscaped courtyards on the Chroy Changvar peninsula, CIRA Residences balances monumental exterior stillness with cool, tactile interior volumes.\n\n> Every threshold was calibrated so tropical daylight shifts gently across raw travertine and timber from morning until dusk.\n\nBy pairing deep shaded terraces with acoustic-insulated private suites, each residence accommodates both sovereign entertaining in the capital and quiet family retreat.",
                'sub_images'    => [
                    [
                        'url'     => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1400&q=85',
                        'caption' => 'Garden pavilion interface blending indoor dining with shaded river-breeze terraces.',
                    ],
                ],
                'is_published'  => true,
            ],
            [
                'title'         => 'Materiality for the Cambodian Climate: Curating Noble Finishes',
                'slug'          => 'materiality-for-the-cambodian-climate-noble-finishes',
                'category'      => 'INSPIRATION',
                'date_string'   => 'OCTOBER 04, 2026',
                'image_url'     => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1800&q=85',
                'image_caption' => 'Honed natural limestone, brushed bronze hardware, and sustainably sourced Cambodian hardwood.',
                'excerpt'       => 'Why breathable natural stone, unlacquered bronze, and seasoned tropical hardwoods age with quiet dignity in Southeast Asian luxury residences.',
                'content'       => "In contemporary luxury design across Phnom Penh, restraint is the rarest discipline. Rather than relying on synthetic surface ornament, our studio selects unlacquered bronze, honed limestone, and seasoned regional hardwoods that breathe naturally in high humidity and develop a rich patina over time.\n\nWhen paired with concealed lighting and disciplined architectural proportions, these mineral palettes create interiors that remain timeless decades after completion.",
                'sub_images'    => [],
                'is_published'  => true,
            ],
        ];

        foreach ($articles as $article) {
            NewsArticle::updateOrCreate(
                ['slug' => $article['slug']],
                $article
            );
        }
    }
}
