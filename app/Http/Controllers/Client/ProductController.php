<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        try {
            $validated = $request->validate([
                'productId' => 'required|exists:products,id',
                'actionType' => 'required|in:INCREASE,DECREASE'
            ]);
    
            if($validated['actionType'] === 'INCREASE') {
                Product::whereId($validated['productId'])->increment('favorite');
            }else {
                Product::whereId($validated['productId'])->decrement('favorite');
            }

            return response(['status' => true, 'message' => 'Cập nhật số lượt yêu thích sản phẩm thành công'], 200);
        } catch(ValidationException $e) {
            return response([
                'status' =>  false, 
                'message' => 'Cập nhật số lượt yêu thích sản phẩm thất bại',
                'reason' => 'Nguyên nhân: ' . $e
            ], 422);
        } catch(\Exception $e) {
            return response([
                'status' => false, 
                'message' => 'Cập nhật số lượt yêu thích sản phẩm thất bại',
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
        } catch(ValidationException $e) {
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
} 