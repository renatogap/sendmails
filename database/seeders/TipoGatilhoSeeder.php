<?php

namespace Database\Seeders;

use App\Models\Entity\TipoGatilho;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoGatilhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_gatilho')->delete();

        $campanhas = [
            [
                'id' => 1,
                'nome' => 'IMEDIATAMENTE',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'nome' => 'DATA',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'nome' => 'SEMANA(S)',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'nome' => 'HORA(S)',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'nome' => 'MINUTO(S)',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        TipoGatilho::insert($campanhas);
    }
}
