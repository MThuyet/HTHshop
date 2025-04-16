<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('limit-row-length', 10);
        $search = $request->get('search');

        $query = ProductCategory::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        $productCategory = $query->paginate($perPage);

        return view('pages.admin.product-category.index', compact('productCategory', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.admin.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->merge([
                'slug' => Str::slug($request->input('name')),
                'active' => $request->has('active')
            ]);
            // Validate input
            $validated = $request->validate([
                'name' => 'required|max:100|unique:product_categories',  // Kiểm tra tên danh mục phải duy nhất
                'slug' => 'required|max:120|unique:product_categories',  // Kiểm tra slug phải duy nhất
                'description' => 'nullable|string',  // Mô tả có thể 524để trống
                'active' => 'required|boolean',  // Trạng thái có thể là 1 (hiển thị) hoặc 0 (ẩn)
            ]);
            // Tạo mới danh mục sản phẩm

            ProductCategory::create($validated);

            // Trả về thông báo thành công
            return redirect()->route('admin.product-category.index')->with('toast', [
                'title' => 'Tạo danh mục thành công',
                'text' => 'Danh mục sản phẩm mới đã được tạo.',
                'icon' => 'success'
            ]);
        } catch (ValidationException $e) {
            // Xử lý lỗi validate nếu có
            $firstField = array_key_first($e->errors());
            $firstError = $e->errors()[$firstField][0];

            return redirect()->back()->with('toast', [
                'title' => 'Lỗi tạo danh mục',
                'text' => $firstError,
                'icon' => 'error'
            ]);
        } catch (\Exception $e) {
            // Xử lý các lỗi không mong muốn
            return redirect()->back()->with('toast', [
                'title' => 'Tạo danh mục thành công',
                'text' => 'Thành công: ' . $e->getMessage(),
                'icon' => 'success'
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        return view('pages.admin.product-category.show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ProductCategory $productCategory)
    {
        //
        return view('pages.admin.product-category.edit', [
            'category' => $productCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $category = ProductCategory::findOrFail($id);
        //
        try {
            $request->merge([
                'slug' => Str::slug($request->input('name')),
                'active' => $request->has('active')
            ]);

            $validated = $request->validate([
                'name' => 'required|max:100|unique:product_categories,name,' . $id,
                'slug' => 'required|max:120|unique:product_categories,slug,' . $id,
                'description' => 'nullable|string|max:255',
                'active' => 'boolean'
            ]);

            $category = ProductCategory::findOrFail($id);
            $category->update($validated);

            return redirect()->back()->with('toast', [
                'title' => 'Cập nhật thành công',
                'text' => 'Thông tin danh mục sản phẩm đã được cập nhật',
                'icon' => 'success'
            ]);
        } catch (ValidationException $e) {
            $firstField = array_key_first($e->errors());
            $firstError = $e->errors()[$firstField][0];

            return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật',
                'text' => $firstError,
                'icon' => 'error'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('toast', [
                'title' => 'Cập nhật thất bại',
                'text' => 'Lỗi: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }


    public function toggleActive(ProductCategory $productCategory)
    {
        try {
            $productCategory->active = !$productCategory->active;
            $productCategory->save();
            return redirect()->route('admin.product-category')->with('toast', [
                'title' => 'Cập nhật trạng thái',
                'text' => 'Cập nhật trạng thái người dùng ' . $productCategory->name . ' thành công',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.product-category')->with('toast', [
                'title' => 'Lỗi cập nhật trạng thái',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        //
        try {
            $category = ProductCategory::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.product-category')->with('toast', [
                'title' => 'Xóa thành công',
                'text' => 'Danh mục sản phẩm đã bị xóa',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.product-category')->with('toast', [
                'title' => 'Xóa thất bại',
                'text' => 'Lỗi: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }
}
