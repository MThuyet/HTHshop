<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
	public function run(): void
	{
		$productIds = DB::table('products')->pluck('id');

		foreach ($productIds as $productId) {
			for ($i = 1; $i <= 2; $i++) {
				DB::table('product_images')->insert([
					'product_id' => $productId,
					'image' => "sample.png",
					'created_at' => now(),
					'updated_at' => now(),
				]);
			}
		}
	}
}
