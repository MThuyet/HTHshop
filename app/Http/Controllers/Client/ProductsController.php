<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
	public function toggleFavorite(Request $request)
	{
		try {
			$validated = $request->validate([
				'productId' => 'required|exists:products,id',
				'actionType' => 'required|in:INCREASE,DECREASE'
			]);

			if ($validated['actionType'] === 'INCREASE') {
				Product::whereId($validated['productId'])->increment('favorite');
				return response(['status' => true, 'message' => 'Thêm sản phẩm vào mục yêu thích thành công'], 200);
			} else {
				Product::whereId($validated['productId'])->decrement('favorite');
				return response(['status' => true, 'message' => 'Xóa sản phẩm trong mục yêu thích thành công'], 200);
			}
		} catch (ValidationException $e) {
			return response([
				'status' =>  false,
				'message' => 'Lỗi không mong muốn',
				'reason' => 'Nguyên nhân: ' . $e
			], 422);
		} catch (\Exception $e) {
			return response([
				'status' => false,
				'message' => 'Lỗi không mong muốn',
				'reason' => 'Nguyên nhân: ' . $e
			], 500);
		}
	}

	public function getProductsByIds(Request $request)
	{
		try {
			$validated = $request->validate([
				'productIds'   => 'required|array',
				'productIds.*' => 'integer|exists:products,id',
			]);

			$productList = Product::whereIn('id', $validated['productIds'])
				->with('variants')
				->with('images')
				->get();

			return response()->json([
				'status' => true,
				'productList' => $productList,
				'message' => 'Lấy thông tin sản phẩm yêu thích thành công',
			]);
		} catch (ValidationException $e) {
			return response([
				'status' =>  false,
				'message' => 'Lấy thông tin sản phẩm yêu thích thất bại',
				'reason' => 'Nguyên nhân: ' . $e
			], 422);
		} catch (\Exception $e) {
			return response([
				'status' => false,
				'message' => 'Lấy thông tin sản phẩm yêu thích thất bại',
				'reason' => 'Nguyên nhân: ' . $e
			], 500);
		}
	}

	public function suggestProducts(Request $request)
	{
		try {
			$query = $request->input('query');

			if (empty($query)) {
				return response()->json([
					'suggestions' => []
				]);
			}

			$products = Product::where('active', 1)
				->where('name', 'LIKE', "%{$query}%")
				->limit(10)
				->with('images')
				->with('variants')
				->get(['id', 'name', 'slug', 'discount']);

			$formattedProducts = $products->map(function ($product) {
				$firstImage = $product->images->first();
				$firstVariant = $product->variants->first();
				$discountedPrice = $firstVariant ? $firstVariant->price - ($firstVariant->price * $product->discount / 100) : 0;

				return [
					'id' => $product->id,
					'name' => $product->name,
					'slug' => $product->slug,
					'image' => $firstImage ? $firstImage->image : null,
					'price' => $firstVariant ? $firstVariant->price : null,
					'discount' => $product->discount,
					'discountedPrice' => $discountedPrice
				];
			});

			return response()->json([
				'suggestions' => $formattedProducts
			]);
		} catch (\Exception $e) {
			return response()->json([
				'suggestions' => [],
				'error' => $e->getMessage()
			], 500);
		}
	}
}
