<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderDetailSeeder extends Seeder
{
	public function run(): void
	{
		$now = Carbon::now();

		// Lấy danh sách ID đơn hàng và biến thể sản phẩm (giả sử đã có sẵn)
		$orderIds = DB::table('orders')->pluck('id')->toArray();
		$variantIds = DB::table('product_variants')->pluck('id')->toArray();

		foreach ($orderIds as $orderId) {
			$detailCount = rand(1, 3); // Mỗi đơn có 1-3 sản phẩm
			for ($i = 0; $i < $detailCount; $i++) {
				DB::table('order_details')->insert([
					'order_id' => $orderId,
					'product_variant_id' => $variantIds[array_rand($variantIds)],
					'quantity' => rand(1, 5),
					'custom_image' => rand(0, 1) ? 'uploads/customs/sample.png' : null,
					'created_at' => $now,
					'updated_at' => $now,
				]);
			}
		}
	}
}
