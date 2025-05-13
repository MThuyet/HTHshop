<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
	public function index(Request $request)
	{
		// Lấy toàn bộ danh mục sản phẩm đang active để hiển thị checkbox filter
		$categories = ProductCategory::where('active', 1)->get();

		// Khởi tạo query builder cho model Product với điều kiện active
		$query = Product::where('active', 1);

		// Biến lưu giá trị filter đã chọn để truyền lại view (phục vụ checked lại checkbox)
		$selectedCategories = [];
		$selectedNeckTypes = [];

		// Nếu là phương thức POST (khi người dùng bấm "Áp dụng bộ lọc")
		if ($request->isMethod('post')) {
			$searchKeyword  = $request->input('searchValue');

			if (!empty($searchKeyword)) {
				$query->where(function ($q) use ($searchKeyword) {
					$q->where('name', 'LIKE', "%$searchKeyword%");
				});
			}

			// Lấy danh sách category được chọn từ form
			$selectedCategories = $request->input('categories', []);

			// Lấy danh sách cổ áo được chọn từ form
			$selectedNeckTypes = $request->input('neckTypes', []);

			// Nếu có chọn danh mục thì lọc theo danh mục
			if (!empty($selectedCategories)) {
				// Đảm bảo chỉ lấy các sản phẩm từ các danh mục active
				$query->whereIn('product_category_id', function ($subquery) use ($selectedCategories) {
					$subquery->select('id')
						->from('product_categories')
						->whereIn('id', $selectedCategories)
						->where('active', 1);
				});
			}

			// Nếu có chọn loại cổ áo thì lọc theo cổ áo
			if (!empty($selectedNeckTypes)) {
				$query->whereIn('type', $selectedNeckTypes);
			}
		} else {
			// Mặc định chỉ lấy sản phẩm từ các danh mục active
			$query->whereIn('product_category_id', function ($subquery) {
				$subquery->select('id')
					->from('product_categories')
					->where('active', 1);
			});
		}

		// Thực hiện truy vấn, lấy danh sách sản phẩm đã lọc (hoặc tất cả nếu không có filter)
		$products = $query->get();

		// Lấy image cho mỗi sản phẩm
		foreach ($products as $product) {
			// Lấy ảnh sản phẩm đầu tiên (hoặc có thể thay đổi nếu cần nhiều ảnh)
			$product->product_image = $product->images()->first();
			$product->product_variant = $product->variants()->first();
		}

		// Trả về view cùng với các dữ liệu cần thiết
		return view('pages.client.ProductListPage', compact(
			'categories',            // Danh sách danh mục để render filter
			'products',              // Danh sách sản phẩm đã lọc
			'selectedCategories',    // Các danh mục đã được chọn
			'selectedNeckTypes'      // Các loại cổ áo đã được chọn
		));
	}
}
