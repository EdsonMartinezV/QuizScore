<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Team::create([
            'name' => 'Norte'
        ]);

        Team::create([
            'name' => 'Centro'
        ]);

        Team::create([
            'name' => 'Sur'
        ]);

        Team::create([
            'name' => 'Oriente'
        ]);

        Team::create([
            'name' => 'Occidente'
        ]);

        Team::create([
            'name' => 'Noreste'
        ]);

        Team::create([
            'name' => 'Noroccidental'
        ]);

        Team::create([
            'name' => 'Sur Sierra'
        ]);

        Team::create([
            'name' => 'Sur Fronterizo'
        ]);

        Team::create([
            'name' => 'Sur Pacífico'
        ]);

        Team::create([
            'name' => 'Oaxaca'
        ]);

        Team::create([
            'name' => 'Oaxaca Norponiente'
        ]);
    }
}
