<?php

namespace Database\Seeders;

use App\Models\Entity\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tag')->delete();

        $tags = [
            [
                'id' => 1,
                'nome' => '[LAUNCH][OBRIGADO]',
                'tag' => 'PROG10X_LS_#1',
                'descricao' => 'Tag de inscrição ao evento.',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        Tag::insert($tags);
    }
}
