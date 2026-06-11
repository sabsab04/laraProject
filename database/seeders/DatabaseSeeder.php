<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
      

        DB::table('users')->insert([
            [
                'name'         => 'Clie',
                'surname'      => 'Clie',
                'username'     => 'clieclie',
                'email'        => 'clieclie@unifun.it',
                'password'     => Hash::make('KjbnKjbn'),
                'role'         => 'user',
                'birth_date'   => '2000-01-01',
                'organization' => null,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'name'         => 'Orga',
                'surname'      => 'Orga',
                'username'     => 'orgaorga',
                'email'        => 'orgaorga@unifun.it',
                'password'     => Hash::make('KjbnKjbn'),
                'role'         => 'organizzatore',
                'birth_date'   => '2000-01-01',
                'organization' => 'FunForYoungs',
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'name'         => 'Admin',
                'surname'      => 'Admin',
                'username'     => 'adminadmin',
                'email'        => 'adminadmin@unifun.it',
                'password'     => Hash::make('KjbnKjbn'),
                'role'         => 'admin',
                'birth_date'   => '2000-01-01',
                'organization' => null,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
        ]);
    }
}