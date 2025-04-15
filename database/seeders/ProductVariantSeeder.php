<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
	public function run(): void
	{
		$printPositions = ['CENTER_CHEST_A4', 'CENTER_BACK_A4', 'BOTH_SIDES'];
		$now = now();

		for ($productId = 1; $productId <= 4; $productId++) {
			foreach ($printPositions as $position) {
				DB::table('product_variants')->insert([
					'price' => 359000,
					'print_position' => $position,
					'product_id' => $productId,
					'created_at' => $now,
					'updated_at' => $now,
				]);
			}
		}
	}
}
