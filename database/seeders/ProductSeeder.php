<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
	public function run(): void
	{
		$now = now();

		$products = [
			[
				'product_category_id' => 1,
				'type' => 'ROUND_NECK',
				'name' => 'Áo thun trơn nam basic',
				'slug' => Str::slug('Áo thun trơn nam basic'),
				'description' => 'Áo thun trơn cổ tròn dành cho nam, chất liệu cotton 100%.',
			],
			[
				'product_category_id' => 2,
				'type' => 'COLLAR_NECK',
				'name' => 'Áo polo nữ năng động',
				'slug' => Str::slug('Áo polo nữ năng động'),
				'description' => 'Áo polo nữ form đẹp, thoáng mát, thích hợp cho hoạt động ngoài trời.',
			],
			[
				'product_category_id' => 3,
				'type' => 'ROUND_NECK',
				'name' => 'Áo cặp đôi dễ thương',
				'slug' => Str::slug('Áo cặp đôi dễ thương'),
				'description' => 'Áo đôi cổ tròn với thiết kế hình in đáng yêu.',
			],
			[
				'product_category_id' => 4,
				'type' => 'COLLAR_NECK',
				'name' => 'Áo sơ mi bé trai',
				'slug' => Str::slug('Áo sơ mi bé trai'),
				'description' => 'Áo sơ mi cổ bẻ dành cho bé trai từ 4-10 tuổi.',
			],
		];

		foreach ($products as $product) {
			DB::table('products')->insert(array_merge($product, [
				'active' => 1,
				'discount' => 0,
				'has_customization' => false,
				'created_at' => $now,
				'updated_at' => $now,
			]));
		}
	}
}
