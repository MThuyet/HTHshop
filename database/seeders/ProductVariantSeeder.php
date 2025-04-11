<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
	public function run(): void
	{
		$sizes = ['1', '2', '3', '4', '5', '6', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
		$colors = [
			['code' => '#000000', 'name' => 'Den'],
			['code' => '#FFFFFF', 'name' => 'Trang'],
		];
		$printPositions = ['CENTER_CHEST_A4', 'CENTER_BACK_A4'];
		$now = now();

		for ($productId = 1; $productId <= 4; $productId++) {
			foreach ($colors as $color) {
				foreach ($sizes as $size) {
					foreach ($printPositions as $position) {
						DB::table('product_variants')->insert([
							'color_code' => $color['code'],
							'price' => 199000,
							'size' => $size,
							'print_position' => $position,
							'image' => 'images/products/sample.jpg',
							'product_id' => $productId,
							'created_at' => $now,
							'updated_at' => $now,
						]);
					}
				}
			}
		}
	}
}
