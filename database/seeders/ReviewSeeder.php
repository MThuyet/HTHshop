<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
	public function run(): void
	{
		$productIds = DB::table('products')->pluck('id')->toArray();
		$now = Carbon::now();

		foreach ($productIds as $productId) {
			$reviewCount = 4; // Mỗi sản phẩm có 4 review
			for ($i = 0; $i < $reviewCount; $i++) {
				DB::table('reviews')->insert([
					'product_id' => $productId,
					'rated' => rand(3, 5),
					'content' => fake()->paragraph(),
					'image' => rand(0, 1) ? 'uploads/reviews/sample.jpg' : null,
					'phone' => '09' . rand(10000000, 99999999),
					'fullname' => fake()->name(),
					'active' => rand(0, 1),
					'created_at' => $now,
					'updated_at' => $now,
				]);
			}
		}
	}
}
