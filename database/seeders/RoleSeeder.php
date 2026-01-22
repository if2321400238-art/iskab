<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrator dengan akses penuh',
            ],
            [
                'name' => 'BPH PB',
                'slug' => 'bph_pb',
                'description' => 'BPH Pusat Besar - Approve/Tolak/Revisi SK',
            ],
            [
                'name' => 'BPH Korwil',
                'slug' => 'bph_korwil',
                'description' => 'BPH Koordinator Wilayah - Input Rayon & Anggota',
            ],
            [
                'name' => 'BPH Rayon',
                'slug' => 'bph_rayon',
                'description' => 'BPH Rayon - Input Anggota',
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'description' => 'Editor Berita & Pena Santri',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }
    }
}
