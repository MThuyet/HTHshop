<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
	public function run(): void
	{
		$categories = [
			'Tin nổi bật',
			'Tin mới',
			'Khuyến mãi',
			'Sự kiện',
		];

		foreach ($categories as $name) {
			DB::table('news_categories')->insert([
				'name' => $name,
				'slug' => Str::slug($name),
				'active' => true,
				'description' => 'Danh mục: ' . $name,
				'created_at' => now(),
				'updated_at' => now(),
			]);
		}
	}
}
