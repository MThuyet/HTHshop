<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\News;
use Carbon\Carbon;

class DashBoardController extends Controller
{
	public function index()
	{
		$totalRevenue = Order::where('status', '=', 'DONE')->sum('total_price');
		$totalOrder = Order::count('order_code');
		$totalProduct = Product::count('id');
		$totalNews = News::count('id');
		$firstSaleDate = Order::orderBy('created_at')
			->where('status', '=', 'DONE')
			->value('created_at');
		return view('pages.admin.dashboard', compact('totalRevenue', 'totalOrder', 'totalProduct', 'totalNews', 'firstSaleDate'));
	}

	public function getTopFavoriteProducts()
	{
		$topFavoriteProductList = Product::select('name', 'favorite')
			->where('favorite', '>', 0)
			->orderBy('favorite', 'desc')
			->limit(10)
			->get();

		return response([
			'status' => true,
			'data' => $topFavoriteProductList,
		], 200);
	}

	public function getTopViewProducts()
	{
		$topViewProductList = Product::select('name', 'view')
			->where('view', '>', 0)
			->orderBy('view', 'desc')
			->limit(10)
			->get();

		return response([
			'status' => true,
			'data' => $topViewProductList,
		], 200);
	}

	public function getTopWatchNews()
	{
		$topWatchNewsList = News::select('title as name', 'watch')
			->where('watch', '>', 0)
			->orderBy('watch', 'desc')
			->limit(3)
			->get();

		return response([
			'status' => true,
			'data' => $topWatchNewsList,
		], 200);
	}

	public function revenueChart(Request $request)
	{
		$from = Carbon::parse($request->input('from', now()->startOfMonth()));
		$to = Carbon::parse($request->input('to', now()));

		$revenues = Order::selectRaw('DATE(created_at) as period, SUM(total_price) as revenue')
			->whereBetween('created_at', [$from->startOfDay(), $to->endOfDay()])
			->where('status', '=', 'DONE')
			->groupBy('period')
			->orderBy('period')
			->get();

		// Nếu request là AJAX thì trả JSON
		if ($request->ajax()) {
			return response()->json($revenues);
		}
	}

	public function getOrderStatusData()
	{
		// Get the order counts by status
		$orderStatusCounts = Order::selectRaw('status, COUNT(*) as order_count')
			->groupBy('status')
			->get();

		// Return the response as JSON
		return response()->json([
			'status' => true,
			'data' => $orderStatusCounts
		]);
	}
}
