<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'super_admin'],
            ['label' => 'Super Administrator']
        );

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'role_id'   => $role->id,
                'name'      => 'Sak',
                'password'  => 'admin123',
                'is_active' => true,
            ]
        );

        $this->call([
            ServiceSeeder::class,
            ProjectSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
