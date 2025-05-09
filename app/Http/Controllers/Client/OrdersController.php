<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
	public function index()
	{
		return view('pages.client.OrderPage');
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
			OrderDetail::create([
				'order_id' => $order->id,
				'product_variant_id' => $item['productVariantId'],
				'quantity'       => $item['quantity'],
				'color'          => $item['color'],
				'size'           => $item['size'],
				'custom_image'   => $item['customImagePath'] ?? null,
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
