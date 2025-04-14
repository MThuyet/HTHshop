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
				'email' => 'admin@admin.com',
				'phone' => '0332393031',
				'password' => Hash::make('admin123'),
				'description' => 'Quản trị viên full quyền',
				'active' => 1,
				'role' => 'ADMIN',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'fullname' => 'Staff',
				'email' => 'staff@staff.com',
				'phone' => '0399999999',
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
