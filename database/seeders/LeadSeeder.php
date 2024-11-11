<?php

namespace Database\Seeders;

use App\Models\Entity\Lead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lead')->delete();

        $campanhas = [
            [
                'id' => 1,
                'campanha_id' => 1,
                'email' => 'renato.19gp@gmail.com',
                'concordo_termos' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        Lead::insert($campanhas);
    }
}
