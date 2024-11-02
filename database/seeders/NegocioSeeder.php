<?php

namespace Database\Seeders;

use App\Models\Entity\Negocio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NegocioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('negocio')->delete();

        $negocios = [
            [
                'id' => 1,
                'nome_metodo' => 'PROGRAMADOR 10x',
                'nicho' => 'Programação',
                'subnicho' => 'Programador Full Stack',
                'roma' => 'Te ensino como aprender programação 10x mais rápido e se tornar um programador full stack profissional.',
                'avatar' => 'HOMENS e MULHERES\n IDADE entre 20 a 50 anos\n INICIANTES NA PROGRAMAÇÃO.',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        Negocio::insert($negocios);
    }
}
