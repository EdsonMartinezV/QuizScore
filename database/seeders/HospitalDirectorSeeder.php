<?php

namespace Database\Seeders;

use App\Models\HospitalDirector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalDirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HospitalDirector::create([
            'name' => 'Manuel de Jesús',
            'paternal_surname' => 'Jiménez',
            'maternal_surname' => 'Palacios',
            'professional_license' => '7318694',
            'doctor_id' => 276
        ]);
    }
}
