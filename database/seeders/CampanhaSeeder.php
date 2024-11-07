<?php

namespace Database\Seeders;

use App\Models\Entity\Campanha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampanhaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('campanha')->delete();

        $campanhas = [
            [
                'id' => 1,
                'negocio_id' => 1,
                'nome' => '[LANCAMENTO][SEMENTE]',
                'versao' => '#1',
                'dt_inicio_campanha' => '2024-11-01 04:02:55',
                'dt_termino_campanha' => '2024-11-20 19:00:00',
                'meta_captura_leads' => '1000',
                'meta_leads_na_live' => '100',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        Campanha::insert($campanhas);
    }
}
