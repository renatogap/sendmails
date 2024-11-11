<?php

namespace Database\Seeders;

use App\Models\Entity\LeadTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lead_tag')->delete();

        $campanhas = [
            [
                'id' => 1,
                'lead_id' => 1,
                'tag' => 'PROG10X_LS_#1',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        LeadTag::insert($campanhas);
    }
}
