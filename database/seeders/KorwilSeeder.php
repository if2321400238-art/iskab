<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Korwil;

class KorwilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $korwils = [
            [
                'name' => 'ISKAB Jabar',
                'wilayah' => 'Jawa Barat',
                'nomor_sk' => 'SK/001/2023',
                'tanggal_sk' => '2023-01-15',
                'description' => 'Koordinator Wilayah Jawa Barat',
                'contact' => '0812345678',
            ],
            [
                'name' => 'ISKAB Jatim',
                'wilayah' => 'Jawa Timur',
                'nomor_sk' => 'SK/002/2023',
                'tanggal_sk' => '2023-02-20',
                'description' => 'Koordinator Wilayah Jawa Timur',
                'contact' => '0823456789',
            ],
            [
                'name' => 'ISKAB DIY',
                'wilayah' => 'Daerah Istimewa Yogyakarta',
                'nomor_sk' => 'SK/003/2023',
                'tanggal_sk' => '2023-03-10',
                'description' => 'Koordinator Wilayah DIY',
                'contact' => '0834567890',
            ],
        ];

        foreach ($korwils as $korwil) {
            Korwil::firstOrCreate(['name' => $korwil['name']], $korwil);
        }
    }
}
