<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Review;

class ProductDetailController extends Controller
{
	public function index($product_slug)
	{
		$product = Product::where('slug', $product_slug)->first();
		$product->images = $product->images()->get();
		$product->variants = $product->variants()->get();

		// Lấy sản phẩm liên quan cùng danh mục
		$relatedProducts = Product::where('product_category_id', $product->product_category_id)
			->where('id', '!=', $product->id)
			->where('active', 1)
			->with(['images' => function ($query) {
				$query->first();
			}, 'variants' => function ($query) {
				$query->where('print_position', 'CENTER_CHEST_A4')->first();
			}])
			->limit(4)
			->get();

		return view('pages.client.ProductDetailPage', compact('product', 'relatedProducts'));
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

	public function storeReview(Request $request, $product_slug)
	{
		// Tìm sản phẩm theo slug
		$product = Product::where('slug', $product_slug)->firstOrFail();

		// Xác thực dữ liệu
		$validated = $request->validate([
			'fullname' => 'required|string|max:255',
			'phone' => 'required|string|max:20',
			'rated' => 'required|integer|between:1,5',
			'content' => 'required|string',
			'image' => 'nullable|image|max:2048', // Giới hạn file ảnh 2MB
		]);

		// Xử lý upload hình ảnh (nếu có)
		$imagePath = null;
		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
			$extension = $image->getClientOriginalExtension();
			$filename = Str::slug($originalName) . '_' . time() . '.' . $extension;
			$imagePath = $image->storeAs('images/reviews', $filename, 'public');
		}

		// Lưu đánh giá vào database
		$review = new Review();
		$review->product_id = $product->id;
		$review->fullname = $validated['fullname'];
		$review->phone = $validated['phone'];
		$review->rated = $validated['rated'];
		$review->content = $validated['content'];
		$review->image = $imagePath;
		$review->active = true;
		$review->save();

		// Trả về thông báo thành công
		return redirect()->back()->with('toast', [
			'icon' => 'success',
			'title' => 'HTH Shop',
			'text' => 'Cảm ơn bạn đã đánh giá sản phẩm của chúng tôi!'
		]);
	}
}
