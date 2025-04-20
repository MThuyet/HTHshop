<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	public function run(): void
	{
		DB::table('users')->insert([
			[
				'fullname' => 'Admin',
				'username' => 'admin',
				'password' => Hash::make('admin123'),
				'description' => 'Quản trị viên full quyền',
				'active' => 1,
				'role' => 'ADMIN',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'fullname' => 'Staff',
				'username' => 'staff',
				'password' => Hash::make('staff123'),
				'description' => 'Nhân viên hỗ trợ',
				'active' => 1,
				'role' => 'STAFF',
				'created_at' => now(),
				'updated_at' => now(),
			],
		]);
	}
}
