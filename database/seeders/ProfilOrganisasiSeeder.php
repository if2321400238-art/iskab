<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilOrganisasi;

class ProfilOrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilOrganisasi::firstOrCreate(['id' => 1], [
            'nama_organisasi' => 'Ikatan Santri Kota Bandung',
            'logo_path' => null,
            'sejarah' => 'ISKAB adalah organisasi yang didirikan dengan tujuan menghimpun santri dari berbagai pesantren di Kota Bandung untuk membangun ukhuwah dan menyebarkan ajaran islam yang rahmatan lil alamin.',
            'visi' => 'Menjadi organisasi santri yang solid, islami, dan produktif dalam memberdayakan santri serta berkontribusi pada masyarakat dan bangsa.',
            'misi' => json_encode([
                'Membangun ukhuwah antar santri dari berbagai pesantren',
                'Meningkatkan pemahaman dan pengamalan nilai-nilai islam',
                'Memberdayakan santri melalui berbagai program dan kegiatan',
                'Berkontribusi aktif dalam kemajuan masyarakat dan bangsa',
            ]),
            'struktur_organisasi' => null,
        ]);
    }
}
