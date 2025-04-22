<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Product;

class HomeController extends Controller
{
	public function index()
	{
		// Lấy 8 sản phẩm mới nhất
		$latestProducts = Product::latest()->take(8)->get();

		// Được ưa chuộng
		$mostFavoritedProducts = Product::orderBy('favorite', 'desc')->take(8)->get();

		// Top bán chạy
		$bestSellingProducts = Product::orderBy('bought', 'desc')->take(8)->get();

		// Gán hình ảnh đầu tiên cho từng sản phẩm
		foreach ([$latestProducts, $mostFavoritedProducts, $bestSellingProducts] as $productList) {
			foreach ($productList as $product) {
				$product->product_image = $product->images()->first();
				$product->product_variant = $product->variants()->first();
			}
		}

		// Tin tức mới nhất
		$latestNews = News::latest()->take(4)->get();

		return view('pages.client.HomePage', compact(
			'latestProducts',
			'mostFavoritedProducts',
			'bestSellingProducts',
			'latestNews'
		));
	}
}
