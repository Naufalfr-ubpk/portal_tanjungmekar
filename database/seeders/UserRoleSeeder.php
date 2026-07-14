<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun ADMIN
        User::create([
            'name' => 'Admin Naufal',
            'email' => 'naufal@admin.com',
            'password' => Hash::make('portal-tm-2026@#$'),
            'role' => 'admin',
        ]);

        // 2. Akun OPERATOR
        User::create([
            'name' => 'Operator Kelurahan',
            'email' => 'pakaji@operator.com',
            'password' => Hash::make('operator990#$%'),
            'role' => 'operator',
        ]);
    }
}