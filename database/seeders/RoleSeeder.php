<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Role::create([
            'description' => 'admin'
        ]);

        Role::create([
            'description' => 'referee'
        ]);

        Role::create([
            'description' => 'downloader'
        ]);

        $adminRole = Role::find(1);
        $adminRole->users()->attach([1, 2, 3]);
    }
}
