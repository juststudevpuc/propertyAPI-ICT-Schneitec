<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyGallery;
use App\Models\Project;
use App\Models\ProjectGallery;
use App\Models\NewsArticle;
use App\Models\Offer;
use App\Models\Experience;
use App\Models\JobOpening;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable mass assignment protection for seeding
        Model::unguard();

        // 1. Admin User Setup
        $role = Role::firstOrCreate(['name' => 'super_admin'], ['label' => 'Super Administrator']);
        User::updateOrCreate(
            ['email' => 'admin@schneitecproperty.com'],
            ['role_id' => $role->id, 'name' => 'Tep Panhasak', 'password' => 'admin123', 'is_active' => true]
        );

        // Clear old seeded data to prevent duplicates if run multiple times
        Schema::disableForeignKeyConstraints();

        DB::table('property_galleries')->truncate();
        DB::table('properties')->truncate();
        DB::table('project_galleries')->truncate();
        DB::table('projects')->truncate();
        DB::table('news_articles')->truncate();
        DB::table('offers')->truncate();
        DB::table('experiences')->truncate();
        DB::table('job_openings')->truncate();

        // Turn them back on
        Schema::enableForeignKeyConstraints();

        // 2. Seed Properties (from hotels.js)
        $prop1 = Property::create([
            'name' => 'The Hearth Phnom Penh',
            'slug' => 'the-hearth-phnom-penh',
            'category' => 'City Center',
            'location' => 'Phnom Penh, Cambodia',
            'starting_rate' => 250.00,
            'overview' => 'A sanctuary of luxury in the heart of the capital.',
            'description' => 'Designed for the discerning traveler, our flagship property features expansive suites, a restorative wellness spa, and an infinity pool overlooking the Mekong River.',
            'amenities' => json_encode(["Signature Spa", "Infinity Pool", "Michelin-starred Dining", "24/7 Butler Service"])
        ]);
        PropertyGallery::create(['property_id' => $prop1->id, 'image_url' => 'https://images.unsplash.com/photo-1542314831-c6a4d27de22f?auto=format&fit=crop&w=1200&q=85', 'label' => 'Cover']);
        PropertyGallery::create(['property_id' => $prop1->id, 'image_url' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461', 'label' => 'Luxury Suite']);

        $prop2 = Property::create([
            'name' => 'Hearth River Retreat Kampot',
            'slug' => 'hearth-river-retreat-kampot',
            'category' => 'Resort',
            'location' => 'Kampot, Cambodia',
            'starting_rate' => 180.00,
            'overview' => 'Nestled along the tranquil Kampot River, this boutique resort offers a peaceful escape.',
            'description' => 'Awaken to the sound of nature in our private riverfront villas. Indulge in authentic local flavors at our riverside restaurant.',
            'amenities' => json_encode(["Private Villas", "Riverfront Dining", "Holistic Spa", "Sunset Cruises"])
        ]);
        PropertyGallery::create(['property_id' => $prop2->id, 'image_url' => 'https://images.unsplash.com/photo-1587061949409-02df41d5e562?auto=format&fit=crop&w=1200&q=85', 'label' => 'Cover']);

        // 3. Seed Projects (from projects.js)
        $proj1 = Project::create([
            'title' => 'Modern Luxury Residence',
            'slug' => 'modern-luxury-residence',
            'category' => 'Residential',
            'overview' => 'A contemporary family home with a calm material palette.',
            'design_approach' => 'The design balances clean architectural lines with warm natural finishes.',
            'highlights' => json_encode(["Open-plan living and dining", "Strong connection to the landscape"])
        ]);
        ProjectGallery::create(['project_id' => $proj1->id, 'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1000&q=80', 'label' => 'Cover']);

        // 4. Seed News Articles (from newsArticles.js)
        NewsArticle::create([
            'title' => 'LEGO Announces Completion of the Nordic Glass Pavilion',
            'slug' => 'nordic-glass-pavilion',
            'category' => 'Projects',
            'excerpt' => 'Our latest project in Copenhagen redefines the boundaries between indoor living and the natural world.',
            'content' => 'Full article content goes here.',
            'image_url' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=1200&q=85',
            'date_string' => 'OCTOBER 14, 2023'
        ]);

        NewsArticle::create([
            'title' => 'Exploring Verticality: The New Urban Housing Initiative',
            'slug' => 'exploring-verticality',
            'category' => 'Insights',
            'excerpt' => 'How we are tackling the challenges of density through modular design and sustainable vertical gardens.',
            'content' => 'Full article content goes here.',
            'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85',
            'date_string' => 'SEPTEMBER 28, 2023'
        ]);

        // 5. Seed Offers
        Offer::create([
            'title' => 'Stay 3, Pay 2',
            'validity' => 'Valid until Dec 31, 2026',
            'description' => 'Enjoy an extended getaway with a complimentary third night when you book our luxury suites.',
            'image_url' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80'
        ]);

        // 6. Seed Experiences
        Experience::create([
            'category' => 'Dining',
            'title' => 'Culinary Excellence',
            'description' => 'Savor exquisite dishes crafted by Michelin-starred chefs in an ambiance of refined luxury.',
            'image_url' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=1200&q=80'
        ]);

        // 7. Seed Job Openings
        JobOpening::create([
            'title' => 'Senior Project Architect',
            'department' => 'Architecture',
            'location' => 'Phnom Penh',
            'type' => 'Full-time'
        ]);

        Model::reguard();
    }
}
