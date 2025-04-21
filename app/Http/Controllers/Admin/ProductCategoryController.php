<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
                'name' => 'required|max:100|unique:product_categories,name',
                'slug' => 'required|max:120|unique:product_categories,slug',
                'description' => 'nullable|string',  
                'active' => 'required|boolean',  
            ]);
            // Tạo mới danh mục sản phẩm

            ProductCategory::create($validated);

            return redirect()->route('admin.product-category')->with('toast', [
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
                'text' => 'Thành công: ',
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
            $hasChanges =
                $validated['name'] !== $category->name ||
                $validated['slug'] !== $category->slug ||
                $validated['description'] !== $category->description ||
                $validated['active'] != $category->active; // != để tránh lỗi kiểu dữ liệu

            if (!$hasChanges) {
                return redirect()->back()->with('toast', [
                    'title' => 'Không có thay đổi',
                    'text' => 'Bạn chưa thay đổi thông tin nào.',
                    'icon' => 'info'
                ]);
            }
            $category->update($validated);

            return redirect()->route('admin.product-category')->with('toast', [
                'title' => 'Tạo danh mục thành công',
                'text' => 'Cập nhật danh mục sản phẩm thành công.',
                'icon' => 'success'
            ]);
        } catch (ValidationException $e) {
            // Xử lý lỗi validate nếu có
            Log::error('Lỗi tạo danh mục', ['error' => $e]);

            return redirect()->back()->with('toast', [
                'title' => 'Lỗi không mong muốn',
                'text' => 'Có lỗi xảy ra, vui lòng thử lại.',
                'icon' => 'error'
            ]);
        } catch (\Exception $e) {
            // Xử lý các lỗi không mong muốn
            return redirect()->back()->with('toast', [
                'title' => 'Cập nhật danh mục thành công',
                'text' => 'Thành công: ',
                'icon' => 'success'
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
                'text' => 'Cập nhật trạng thái danh mục ' . $productCategory->name . ' thành công',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi tạo danh mục', ['error' => $e]);
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
            Log::error('Lỗi tạo danh mục', ['error' => $e]);
            return redirect()->route('admin.product-category')->with('toast', [
                'title' => 'Xóa thất bại',
                'text' => 'Lỗi: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }
}
