<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run(): void
	{
		$this->call([
			UserSeeder::class,
			ProductCategorySeeder::class,
			ProductSeeder::class,
			ProductVariantSeeder::class,
			OrderSeeder::class,
			OrderDetailSeeder::class,
			ReviewSeeder::class,
			NewsCategorySeeder::class,
			NewsSeeder::class,
			ProductImageSeeder::class,
		]);
	}
}
