<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
	public function run(): void
	{
		$printPositions = [
			['position' => 'CENTER_CHEST_A4', 'price' => 150000], // Mặt trước
			['position' => 'CENTER_BACK_A4', 'price' => 170000],  // Mặt sau
			['position' => 'BOTH_SIDES', 'price' => 200000],      // Cả hai mặt
		];
		$now = now();

		for ($productId = 1; $productId <= 4; $productId++) {
			foreach ($printPositions as $variant) {
				DB::table('product_variants')->insert([
					'price' => $variant['price'],
					'print_position' => $variant['position'],
					'product_id' => $productId,
					'created_at' => $now,
					'updated_at' => $now,
					'deleted_at' => null
				]);
			}
		}
	}
}
