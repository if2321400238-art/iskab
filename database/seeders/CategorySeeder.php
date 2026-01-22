<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Organisasi',
                'slug' => 'organisasi',
                'description' => 'Berita seputar organisasi iskab',
            ],
            [
                'name' => 'Kegiatan',
                'slug' => 'kegiatan',
                'description' => 'Berita kegiatan dan acara',
            ],
            [
                'name' => 'Pengumuman',
                'slug' => 'pengumuman',
                'description' => 'Pengumuman penting',
            ],
            [
                'name' => 'Kajian Islam',
                'slug' => 'kajian-islam',
                'description' => 'Konten kajian islam untuk pena santri',
            ],
            [
                'name' => 'Opini Santri',
                'slug' => 'opini-santri',
                'description' => 'Opini dan tulisan santri',
            ],
            [
                'name' => 'Artikel Keislaman',
                'slug' => 'artikel-keislaman',
                'description' => 'Artikel seputar keislaman',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
