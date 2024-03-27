<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'token' => strtoupper(Str::random(20)),
                'role_id' => 1,
                'room_id' => null,
                'name' => 'Nguyễn Văn A',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1234'),
                'phone' => '012345678',
                'cccd' => '0123456789',
                'address' => 'Hà Nội',
                'avatar' => null,
                'is_active' => true
            ],
            [
                'token' => strtoupper(Str::random(20)),
                'role_id' => 2,
                'room_id' => null,
                'name' => 'Nguyễn Văn B',
                'email' => 'user@gmail.com',
                'password' => Hash::make('1234'),
                'phone' => '012345678',
                'cccd' => '0123456789',
                'address' => 'Hà Nội',
                'avatar' => null,
                'is_active' => true
            ]
        ]  
        );
    }
}
