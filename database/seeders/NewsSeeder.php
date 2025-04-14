<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
	public function run(): void
	{
		$newsTitles = [
			'Top 5 xu hướng thời trang năm 2025',
			'Chương trình khuyến mãi mùa hè siêu hot',
			'Mẹo phối đồ chất như fashionista',
			'Update công nghệ in áo mới nhất',
			'Bí mật hậu trường: Một ngày tại xưởng in'
		];

		$now = now();

		foreach ($newsTitles as $index => $title) {
			DB::table('news')->insert([
				'title' => $title,
				'slug' => Str::slug($title),
				'excerpt' => 'Mô tả ngắn bài viết: ' . $title,
				'content' => '<p>Nội dung bài viết: ' . $title . '</p>',
				'thumbnail' => 'images/news/sample.png',
				'active' => 1,
				'news_category_id' => ($index % 4) + 1, // vì có 4 category
				'user_id_created' => 1, // giả sử có user id 1
				'user_id_updated' => null,
				'created_at' => $now,
				'updated_at' => $now,
			]);
		}
	}
}
