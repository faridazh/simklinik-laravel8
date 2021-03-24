<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        $data = array(
            array(
                'staffid' => 'STF001',
                'name' => 'Farid Azhar Kusuma',
                'username' => 'YASAKA',
                'email' => 'admin@admin.com',
                'level' => 'Administrator',
                'password' => Hash::make('111222333'),
                'remember_token' => Str::random(60),
            ),
            array(
                'staffid' => 'STF002',
                'name' => 'Fauzia Azizah Kusuma',
                'username' => 'Azizah',
                'email' => 'staff@staff.com',
                'level' => 'Staff',
                'password' => Hash::make('123123123'),
                'remember_token' => Str::random(60),
            ),
        );

        User::insert($data);
    }
}
