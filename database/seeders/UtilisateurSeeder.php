<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        utilisateurs::factory()
            ->count(10)
            ->has(reservation::factory()->count(3))
            ->create();

        utilisateurs::factory()
            ->create(10)
            ->has(reservation::factory()->count(3))
            ->create();
    }
}
