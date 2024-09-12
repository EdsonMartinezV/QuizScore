<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nickname' => 'Edson',
            'password' => Hash::make('EDsonrules14*')
        ]);

        User::create([
            'nickname' => 'Sergio',
            'password' => Hash::make('amelieamelie')
        ]);

        User::create([
            'nickname' => 'Sheila',
            'password' => Hash::make('hoyuelos')
        ]);
    }
}
