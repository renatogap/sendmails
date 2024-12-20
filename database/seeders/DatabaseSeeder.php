<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TagSeeder::class,
            NegocioSeeder::class,
            CampanhaSeeder::class,
            TemplateEmailSeeder::class,
            GatilhoEmailTagSeeder::class,
            TipoGatilhoSeeder::class,
            //LeadSeeder::class,
            //LeadTagSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
