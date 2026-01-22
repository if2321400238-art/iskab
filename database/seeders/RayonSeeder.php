<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rayon;

class RayonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rayons = [
            // Rayons untuk ISKAB Jabar
            [
                'name' => 'Rayon Bandung',
                'korwil_id' => 1,
                'nomor_sk' => 'SK/001/RY/2023',
                'tanggal_sk' => '2023-04-05',
                'description' => 'Rayon Bandung - Jawa Barat',
                'contact' => '0815555555',
            ],
            [
                'name' => 'Rayon Cirebon',
                'korwil_id' => 1,
                'nomor_sk' => 'SK/002/RY/2023',
                'tanggal_sk' => '2023-04-06',
                'description' => 'Rayon Cirebon - Jawa Barat',
                'contact' => '0816666666',
            ],
            // Rayons untuk ISKAB Jatim
            [
                'name' => 'Rayon Surabaya',
                'korwil_id' => 2,
                'nomor_sk' => 'SK/003/RY/2023',
                'tanggal_sk' => '2023-05-10',
                'description' => 'Rayon Surabaya - Jawa Timur',
                'contact' => '0817777777',
            ],
            [
                'name' => 'Rayon Malang',
                'korwil_id' => 2,
                'nomor_sk' => 'SK/004/RY/2023',
                'tanggal_sk' => '2023-05-11',
                'description' => 'Rayon Malang - Jawa Timur',
                'contact' => '0818888888',
            ],
            // Rayons untuk ISKAB DIY
            [
                'name' => 'Rayon Yogyakarta',
                'korwil_id' => 3,
                'nomor_sk' => 'SK/005/RY/2023',
                'tanggal_sk' => '2023-06-01',
                'description' => 'Rayon Yogyakarta - DIY',
                'contact' => '0819999999',
            ],
        ];

        foreach ($rayons as $rayon) {
            Rayon::firstOrCreate(['name' => $rayon['name']], $rayon);
        }
    }
}
