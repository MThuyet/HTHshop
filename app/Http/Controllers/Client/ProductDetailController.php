<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductDetailController extends Controller
{
	public function index($product_slug)
	{
		$product = Product::where('slug', $product_slug)->first();
		$product->images = $product->images()->get();
		$product->variants = $product->variants()->get();
		return view('pages.client.ProductDetailPage', compact('product'));
	}

	public function uploadImage(Request $request)
	{
		try {
			if ($request->hasFile('image') && $request->file('image')->isValid()) {
				$image = $request->file('image');

				// Lấy tên file gốc và làm sạch
				$originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
				$extension = $image->getClientOriginalExtension();
				// Tạo tên file: kết hợp tên gốc với chuỗi duy nhất
				$filename = Str::slug($originalName) . '_' . time() . '.' . $extension;

				// Lưu file vào storage/public/uploads
				$path = $image->storeAs('uploads', $filename, 'public');
				$url = asset('storage/' . $path);

				return response()->json([
					'path' => $path, // Đường dẫn tương đối: uploads/originalname_1634567890.ext
					'url' => $url    // URL đầy đủ: http://yourdomain.com/storage/uploads/originalname_1634567890.ext
				], 200);
			}

			return response()->json([
				'error' => 'Không có ảnh hợp lệ được upload'
			], 400);
		} catch (\Exception $e) {
			return response()->json([
				'error' => 'Lỗi khi upload ảnh: ' . $e->getMessage()
			], 500);
		}
	}
}
