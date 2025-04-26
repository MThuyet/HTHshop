<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$perPage = $request->input('limit-row-length', 10);
        $search = $request->get('search');

		$query = Product::with(['category', 'images', 'variants']);

		// Search functionality
		if ($search) {
			$query->where(function ($q) use ($search) {
				$q->where('name', 'like', "%{$search}%")
					->orWhereHas('category', function ($q) use ($search) {
						$q->where('name', 'like', "%{$search}%");
					});
			});
		}

		// Pagination
		$products = $query->paginate($perPage);

		return view('pages.admin.products.index', compact('products', 'perPage'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$categories = ProductCategory::where('active', true)->get();
		return view('pages.admin.products.create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:100|unique:products',
			'product_category_id' => 'required|exists:product_categories,id',
			'type' => 'required|in:ROUND_NECK,COLLAR_NECK',
			'description' => 'nullable|string',
			'discount' => 'required|integer|min:0|max:100',
			'has_customization' => 'boolean',
			'active' => 'boolean',
			'images' => 'required|array|min:1',
			'images.*' => 'image|max:2048',
			'variants' => 'required|array',
			'variants.*.price' => 'required|integer|min:0',
			'variants.*.print_position' => 'required|string',
		]);

		try {
			DB::beginTransaction();

			// Tạo slug từ tên sản phẩm
			$validated['slug'] = Str::slug($validated['name']);

			// Lấy giá thấp nhất từ các biến thể làm giá mặc định
			$prices = array_map(function ($variant) {
				return $variant['price'];
			}, $request->variants);
			$validated['default_price'] = min($prices);

			// Tạo sản phẩm
			$product = Product::create($validated);

			// Lưu hình ảnh
			foreach ($request->file('images') as $index => $image) {
				$originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
				$extension = $image->getClientOriginalExtension();
				$filename = Str::slug($validated['name']) . '-' . $originalName . '-' . time() . '-' . ($index + 1) . '.' . $extension;
				$path = $image->storeAs('images/products', $filename, 'public');
				$product->images()->create(['image' => $path]);
			}

			// Tạo các biến thể
			foreach ($request->variants as $variant) {
				$product->variants()->create([
					'print_position' => $variant['print_position'],
					'price' => $variant['price']
				]);
			}

			DB::commit();

			return redirect()->route('admin.products')->with('toast', [
				'icon' => 'success',
				'title' => 'HTH Shop',
				'text' => 'Tạo sản phẩm thành công'
			]);
		} catch (\Exception $e) {
			DB::rollBack();

			// Log lỗi
			Log::error('Lỗi khi tạo sản phẩm: ' . $e->getMessage());
			Log::error('Stack trace: ' . $e->getTraceAsString());
			Log::error('Dữ liệu gửi lên: ' . json_encode($request->all()));

			return redirect()->back()->with('toast', [
				'icon' => 'error',
				'title' => 'HTH Shop',
				'text' => 'Có lỗi xảy ra khi tạo sản phẩm: ' . $e->getMessage()
			])->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show($productId)
	{
		$product = Product::findOrFail($productId);
		$product->product_images = $product->images()->get();
		$product->product_variants = $product->variants()->get();
		$product->reviews = $product->reviews()->orderBy('rated', 'asc')->get();
		return view('pages.admin.products.show', compact('product'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$product = Product::findOrFail($id);
		$categories = ProductCategory::where('active', true)->get();
		return view('pages.admin.products.edit', compact('product', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Product $product)
	{
		try {
			DB::beginTransaction();

			// Validate dữ liệu
			$validated = $request->validate([
				'name' => 'required|string|max:100',
				'product_category_id' => 'required|exists:product_categories,id',
				'type' => 'required|in:ROUND_NECK,COLLAR_NECK',
				'description' => 'nullable|string',
				'discount' => 'required|integer|min:0|max:100',
				'has_customization' => 'boolean',
				'active' => 'boolean',
				'images' => 'nullable|array',
				'images.*' => 'image|max:2048',
				'variants' => 'required|array',
				'variants.*.print_position' => 'required|string|in:CENTER_CHEST_A4,CENTER_BACK_A4,BOTH_SIDES',
				'variants.*.price' => 'required|integer|min:0',
			]);

			// Cập nhật thông tin sản phẩm
			$product->update([
				'name' => $validated['name'],
				'product_category_id' => $validated['product_category_id'],
				'type' => $validated['type'],
				'description' => $validated['description'],
				'discount' => $validated['discount'],
				'has_customization' => $validated['has_customization'] ?? false,
				'active' => $validated['active'] ?? false,
			]);

			// Xử lý ảnh mới
			if ($request->hasFile('images')) {
				foreach ($request->file('images') as $image) {
					$path = $image->store('images/products', 'public');
					$product->images()->create(['image' => $path]);
				}
			}

			// Xử lý biến thể
			foreach ($validated['variants'] as $variantId => $variantData) {
				if ($variantId === 'new') {
					// Thêm biến thể mới
					$product->variants()->create([
						'print_position' => $variantData['print_position'],
						'price' => $variantData['price']
					]);
				} else {
					// Cập nhật biến thể hiện có
					$product->variants()->where('id', $variantId)->update([
						'print_position' => $variantData['print_position'],
						'price' => $variantData['price']
					]);
				}
			}

			DB::commit();

			return redirect()->back()
				->with('toast', [
					'icon' => 'success',
					'title' => 'HTH Shop',
					'text' => 'Cập nhật sản phẩm thành công'
				]);
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()
				->with('toast', [
					'icon' => 'error',
					'title' => 'HTH Shop',
					'text' => 'Có lỗi xảy ra khi cập nhật sản phẩm: ' . $e->getMessage()
				])
				->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Product $product)
	{
		try {
			// Kiểm tra xem sản phẩm đã bị xóa mềm chưa
			if ($product->trashed()) {
				return redirect()->route('admin.products')
					->with('toast', [
						'icon' => 'error',
						'title' => 'Lỗi',
						'text' => 'Sản phẩm đã bị xóa trước đó.'
					]);
			}

			// Thực hiện xóa mềm
			$product->delete();

			return redirect()->route('admin.products')
				->with('toast', [
					'icon' => 'success',
					'title' => 'HTH Shop',
					'text' => 'Sản phẩm đã được xóa thành công'
				]);
		} catch (\Exception $e) {
			return redirect()->route('admin.products')
				->with('toast', [
					'icon' => 'error',
					'title' => 'Lỗi',
					'text' => 'Có lỗi xảy ra khi xóa sản phẩm' . $e->getMessage() 
				]);
		}
	}

	/**
	 * Toggle product active status
	 */
	public function toggleActive(string $id)
	{
		$product = Product::findOrFail($id);
		$product->active = !$product->active;
		$product->save();
		return redirect()->back()->with('toast', [
			'icon' => 'success',
			'title' => 'HTH Shop',
			'text' => 'Cập nhật trạng thái của sản phẩm thành công'
		]);;
	}

	public function toggleCustomization(Product $product)
	{
		$product->has_customization = !$product->has_customization;
		$product->save();
		return redirect()->back()->with('toast', [
			'icon' => 'success',
			'title' => 'HTH Shop',
			'text' => 'Cập nhật trạng thái tùy chỉnh của sản phẩm thành công'
		]);
	}

	public function deleteImage(ProductImage $image)
	{
		try {
			// Xóa file ảnh từ storage
			Storage::disk('public')->delete($image->image);

			// Xóa record từ database
			$image->delete();

			return response()->json(['success' => true]);
		} catch (\Exception $e) {
			return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
		}
	}
}
