<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
	public function run(): void
	{
		$now = now();

		$categories = [
			'Áo nam',
			'Áo nữ',
			'Cặp đôi',
			'Trẻ em',
		];

		foreach ($categories as $name) {
			DB::table('product_categories')->insert([
				'name' => $name,
				'slug' => Str::slug($name),
				'description' => null,
				'active' => 1,
				'created_at' => $now,
				'updated_at' => $now,
			]);
		}
	}
}
