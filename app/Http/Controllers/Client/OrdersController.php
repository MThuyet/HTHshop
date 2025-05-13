<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
	public function index()
	{
		return view('pages.client.OrderPage');
	}

	/**
	 * Upload base64 image to storage and return the path
	 */
	private function uploadBase64Image($base64Data)
	{
		// Remove the data:image/xyz;base64, part
		if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $matches)) {
			$imageType = $matches[1];
			$base64Data = substr($base64Data, strpos($base64Data, ',') + 1);
			$decodedData = base64_decode($base64Data);

			if ($decodedData === false) {
				return null;
			}

			$filename = 'custom_' . time() . '_' . Str::random(10) . '.' . $imageType;
			$path = 'uploads/' . $filename;

			Storage::disk('public')->put($path, $decodedData);

			return $path;
		}

		return null;
	}

	public function store(Request $request)
	{
		// Parse JSON từ cart_data
		$cartItems = json_decode($request->input('cart_data'), true);

		if (empty($cartItems)) {
			return back()->with('error', 'Giỏ hàng trống hoặc dữ liệu không hợp lệ!');
		}

		// Tạo đơn hàng
		$order = Order::create([
			'order_code'   => strtoupper(Str::random(10)),
			'email'        => $request->input('email'),
			'fullname'     => $request->input('fullname'),
			'phone'        => $request->input('phone'),
			'location'     => $request->input('location') . ', ' . $request->input('ward') . ', ' . $request->input('district') . ', ' . $request->input('province'),
			'note'         => $request->input('note'),
			'total_price'  => $request->input('total_price'),
			'status'       => 'PENDING',
			'cancel_reason' => null,
		]);

		// Lưu từng sản phẩm trong giỏ hàng vào bảng OrderDetail
		foreach ($cartItems as $item) {
			// Xử lý upload ảnh từ base64 nếu có
			$customImagePath = $item['customImagePath'] ?? null;

			// Nếu có base64 image, upload và lưu đường dẫn
			if (!$customImagePath && isset($item['customImageBase64']) && $item['customImageBase64']) {
				$customImagePath = $this->uploadBase64Image($item['customImageBase64']);
			}

			OrderDetail::create([
				'order_id' => $order->id,
				'product_variant_id' => $item['productVariantId'],
				'quantity'       => $item['quantity'],
				'color'          => $item['color'],
				'size'           => $item['size'],
				'custom_image'   => $customImagePath,
			]);
		}

		// Sau khi lưu xong, có thể redirect hoặc trả JSON tùy mục đích
		return redirect('/')->with('toast', [
			'icon' => 'success',
			'title' => 'Đặt hàng thành công!',
			'text' => 'Cảm ơn bạn đã đặt hàng. HTH Clothes sẽ sớm liên hệ với bạn để xác nhận đơn hàng',
			'timer' => 5000
		]);
	}
}
