<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            KorwilSeeder::class,
            RayonSeeder::class,
            ProfilOrganisasiSeeder::class,
        ]);

        // Create Admin User
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@iskab.com',
            'password' => bcrypt('password'),
            'role_id' => \App\Models\Role::where('slug', 'admin')->first()?->id,
        ]);

        // Create Editor User
        User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@iskab.com',
            'password' => bcrypt('password'),
            'role_id' => \App\Models\Role::where('slug', 'editor')->first()?->id,
        ]);

        // Create BPH PB User
        User::factory()->create([
            'name' => 'BPH PB',
            'email' => 'bphpb@iskab.com',
            'password' => bcrypt('password'),
            'role_id' => \App\Models\Role::where('slug', 'bph_pb')->first()?->id,
        ]);
    }
}
