<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class NewsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('limit-row-length', 10);
        $search = $request->get('search');

        $query = NewsCategory::query();

        if($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        $newsCategories = $query->paginate($perPage);
        
        return view('pages.admin.news-categories.index', compact('newsCategories', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.news-categories.create');
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
    
            $validated = $request->validate([
                'name' => 'required|max:100|unique:news_categories,name',
                'slug' => 'required|max:120|unique:news_categories,slug',
                'description' => 'nullable|string|max:255',
                'active' => 'boolean'
            ]);
    
            NewsCategory::create($validated);
    
            return redirect()->route('dashboard.news-categories')->with('toast', [
                'title' => 'Tạo danh mục thành công',
                'text' => 'Danh mục tin tức mới đã được thêm vào',
                'icon' => 'success'
            ]);
        } catch (ValidationException $e) {
            $firstField = array_key_first($e->errors());
            $firstError = $e->errors()[$firstField][0];
    
            return redirect()->back()->with('toast', [
                'title' => 'Lỗi tạo danh mục',
                'text' => $firstError,
                'icon' => 'error'
            ])->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('toast', [
                'title' => 'Lỗi hệ thống',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsCategory $newsCategory)
    {
        return view('pages.admin.news-categories.show', compact('newsCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsCategory $newsCategory)
    {
        return view('pages.admin.news-categories.edit', compact('newsCategory'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, NewsCategory $newsCategory)
    {
        try {
            $request->merge([
                'slug' => Str::slug($request->input('name')),
                'active' => $request->has('active')
            ]);

            $validated = $request->validate([
                'name' => 'required|max:100|unique:news_categories,name,' . $newsCategory->id,
                'slug' => 'required|max:120|unique:news_categories,slug,' . $newsCategory->id,
                'description' => 'nullable|string|max:255',
                'active' => 'boolean'
            ]);

            if(!$this->checkHasChange($newsCategory->toArray(), $validated)) {
                return redirect()->back()->with('toast', [
                    'title' => 'Không có thay đổi',
                    'text' => 'Bạn chưa thay đổi thông tin nào.',
                    'icon' => 'info'
                ]);
            }

            $newsCategory->update($validated);

            return redirect()->back()->with('toast', [
                'title' => 'Cập nhật thành công',
                'text' => 'Cập nhật danh mục tin tức thành công',
                'icon' => 'success'
            ]);
        } catch (ValidationException $e) {
            $firstField = array_key_first($e->errors());
            $firstError = $e->errors()[$firstField][0];

            return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật danh mục',
                'text' => $firstError,
                'icon' => 'error'
            ])->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật danh mục',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ])->withInput();
        }
    }

    public function toggleActive(NewsCategory $newsCategory)
    {
        try {
            $newsCategory->active = !$newsCategory->active;
            $newsCategory->save();
            return redirect()->back()->with('toast', [
                'title' => 'Cập nhật trạng thái',
                'text' => 'Cập nhật trạng thái danh mục tin tức '. $newsCategory->name .' thành công',
                'icon' => 'success'
            ]);
        } catch(\Exception $e) {
        return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật trạng thái',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsCategory $newsCategory)
    {
        try {
            $newsCategory->delete();

            return redirect()->route('dashboard.news-categories')->with('toast', [
                'title' => 'Xóa thành công',
                'text' => 'Xóa danh mục tin tức thành công',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.news-categories')->with('toast', [
                'title' => 'Lỗi xóa danh mục tin tức',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Check if there are any changes between the old and new data.
     */
    public function checkHasChange(array $oldData, array $newData): bool
    {
        foreach ($newData as $key => $value) {
            if (!array_key_exists($key, $oldData)) continue;
            if ($oldData[$key] != $value) return true;
        }
        return false;
    }
}
