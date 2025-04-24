<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$perPage = request('limit-row-length', 10);
		$search = request('search');

		$orders = Order::query()
			->when($search, function ($query) use ($search) {
				$query->where(function ($q) use ($search) {
					$q->where('order_code', 'like', "%{$search}%")
						->orWhere('fullname', 'like', "%{$search}%")
						->orWhere('phone', 'like', "%{$search}%");
				});
			})
			->orderBy('created_at', 'desc')
			->paginate($perPage);

		return view('pages.admin.order.index', compact('orders', 'perPage'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Order $order)
	{
		return view('pages.admin.order.show', compact('order'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Order $order)
	{
		return view('pages.admin.order.edit', compact('order'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Order $order)
	{
		$validated = $request->validate([
			'status' => 'required|in:PENDING,CONFIRMED,SHIPPING,DONE,CANCELLED',
			'note' => 'nullable|string|max:500',
			'cancel_reason' => 'required_if:status,CANCELLED|nullable|string|max:500',
		]);

		try {
			DB::beginTransaction();

			// Nếu đơn hàng bị hủy, cập nhật lại số lượng sản phẩm
			if ($validated['status'] === 'CANCELLED' && $order->status !== 'CANCELLED') {
				foreach ($order->details as $detail) {
					$product = $detail->variant->product;
					$product->update([
						'quantity' => $product->quantity + $detail->quantity
					]);
				}
			}

			// Cập nhật thông tin đơn hàng
			$order->update($validated);

			DB::commit();

			return redirect()
				->route('admin.order.show', $order)
				->with('toast', [
					'icon' => 'success',
					'title' => 'Thành công',
					'text' => 'Cập nhật đơn hàng thành công'
				]);
		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('toast', [
				'icon' => 'error',
				'title' => 'Lỗi',
				'text' => 'Có lỗi xảy ra khi cập nhật đơn hàng: ' . $e->getMessage()
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
