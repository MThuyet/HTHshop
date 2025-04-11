<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
	public function run(): void
	{
		$statuses = ['IN_CART', 'PENDING', 'CONFIRMED', 'SHIPPING', 'DONE', 'CANCELLED'];
		$now = Carbon::now();

		foreach ($statuses as $index => $status) {
			DB::table('orders')->insert([
				'order_code' => strtoupper(Str::random(10)),
				'email' => "user{$index}@example.com",
				'fullname' => "Người dùng {$index}",
				'location' => "Địa chỉ số {$index}, Quận {$index}, TP.HCM",
				'phone' => '09123456' . $index,
				'note' => $index % 2 === 0 ? "Ghi chú cho đơn hàng {$index}" : null,
				'status' => $status,
				'cancel_reason' => $status === 'CANCELLED' ? 'Khách huỷ vì không cần nữa' : null,
				'total_price' => rand(150000, 1000000),
				'created_at' => $now,
				'updated_at' => $now,
			]);
		}
	}
}
