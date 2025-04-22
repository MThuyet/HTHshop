<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
        ]);

        $productVariantId = $request->product_variant_id;
        $productVariant = ProductVariant::findOrFail($productVariantId);
        $product = $productVariant->product;

        // Lấy danh sách sản phẩm yêu thích từ session
        $favoriteProducts = json_decode($request->session()->get('favoriteProducts', '[]'), true);

        // Kiểm tra xem sản phẩm đã được yêu thích chưa
        if (in_array($productVariantId, $favoriteProducts)) {
            // Xóa sản phẩm khỏi danh sách yêu thích
            $favoriteProducts = array_diff($favoriteProducts, [$productVariantId]);
            $message = 'Đã hủy sản phẩm khỏi danh sách yêu thích';
            // Không giảm số lượt yêu thích khi người dùng bỏ yêu thích
        } else {
            // Kiểm tra xem sản phẩm đã được yêu thích trong session này chưa
            $likedProducts = json_decode($request->session()->get('likedProductsSession', '[]'), true);
            
            // Nếu chưa từng yêu thích trong session này, mới tăng số lượt yêu thích
            if (!in_array($productVariantId, $likedProducts)) {
                $product->increment('favorite');
                // Thêm vào danh sách đã yêu thích trong session này
                $likedProducts[] = $productVariantId;
                $request->session()->put('likedProductsSession', json_encode($likedProducts));
            }
            
            // Thêm sản phẩm vào danh sách yêu thích hiện tại
            $favoriteProducts[] = $productVariantId;
            $message = 'Đã thêm sản phẩm vào danh sách yêu thích';
        }

        // Cập nhật lại danh sách yêu thích trong session
        $request->session()->put('favoriteProducts', json_encode($favoriteProducts));

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'favorite_count' => $product->favorite
        ]);
    }
    public function getProductsByIds(Request $request)
    {
        try {
            $ids = $request->query('ids');
            
            if (!$ids) {
                return response()->json([
                    'products' => [],
                    'message' => 'Không có ID sản phẩm nào được cung cấp'
                ]);
            }
            
            $variantIds = explode(',', $ids);
            Log::info('API được gọi với IDs: ' . json_encode($variantIds));
            
            if (empty($variantIds) || (count($variantIds) === 1 && empty($variantIds[0]))) {
                return response()->json([
                    'products' => [],
                    'message' => 'Danh sách ID không hợp lệ'
                ]);
            }
            
            // Làm sạch ID - chỉ lấy các giá trị số
            $cleanedIds = array_filter($variantIds, function($id) {
                return is_numeric($id) && intval($id) > 0;
            });
            
            if (empty($cleanedIds)) {
                return response()->json([
                    'products' => [],
                    'message' => 'Không có ID hợp lệ'
                ]);
            }
            
            $variants = ProductVariant::whereIn('id', $cleanedIds)
                        ->with('product.images')
                        ->get();
            
            Log::info('Tìm thấy ' . $variants->count() . ' variants');
            
            $products = [];
            
            foreach ($variants as $variant) {
                if ($variant->product) {
                    $productImage = $variant->product->images->first();
                    
                    $products[] = [
                        'id' => $variant->product->id,
                        'name' => $variant->product->name,
                        'slug' => $variant->product->slug,
                        'price' => $variant->price,
                        'discount' => $variant->product->discount,
                        'variant_id' => $variant->id,
                        'image_url' => $productImage ? asset('storage/images/products/' . $productImage->image) : asset('images/placeholder.png'),
                    ];
                }
            }
            
            return response()->json([
                'products' => $products,
                'count' => count($products),
                'requested_ids' => $variantIds,
                'valid_ids' => $cleanedIds
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy sản phẩm yêu thích: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function debugFavoriteProducts(Request $request)
    {
        try {
            $ids = $request->query('ids');
            
            if (!$ids) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không có ID sản phẩm nào được truyền vào',
                    'raw_query' => $request->getQueryString()
                ]);
            }
            
            $variantIds = explode(',', $ids);
            
            return response()->json([
                'status' => 'success',
                'message' => 'ID đã nhận',
                'ids_received' => $variantIds,
                'total_ids' => count($variantIds),
                'query_string' => $request->getQueryString(),
                'raw_request' => $request->all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
} 