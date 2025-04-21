<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$perPage = $request->input('limit-row-length', 10);
		$search = $request->get('search');

		$query = News::query();

		if ($search) {
			$query->where('title', 'like', "%{$search}%");
		}
		$news = $query->paginate($perPage);

		return view('pages.admin.news.index', compact('news', 'perPage'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$newsCategory = NewsCategory::all();
		return view('pages.admin.news.create', compact('newsCategory'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		try {
			$thumbnailPath = null;
			if ($request->has('thumbnail') && !empty($request->thumbnail)) {
				$fileUrl = $request->thumbnail;
				$thumbnailPath = str_replace(['http://127.0.0.1:8000/storage/', '/storage/'], '', $fileUrl);
			}

			$request->merge([
				'slug' => Str::slug($request->title),
				'thumbnail' => $thumbnailPath,
				'active' => $request->has('active'),
				'user_id_created' => Auth::id(),
			]);

			$validated = $request->validate([
				'title' => 'required|string|max:255|unique:news,title',
				'slug' => 'required|string|max:255|unique:news,slug',
				'excerpt' => 'required|string|max:255',
				'thumbnail' => 'required|string|max:255',
				'content' => 'required|string',
				'active' => 'boolean',
				'news_category_id' => 'required|exists:news_categories,id',
				'user_id_created' => 'required|exists:users,id'
			]);

			News::create($validated);

			return redirect()->route('dashboard.news')->with('toast', [
				'title' => 'Thành công',
				'text' => 'Tạo bài viết thành công',
				'icon' => 'success'
			]);
		} catch (ValidationException $e) {
			$firstField = array_key_first($e->errors());
			$firstError = $e->errors()[$firstField][0];

			return redirect()->route('dashboard.news.create')->with('toast', [
				'title' => 'Lỗi tạo tin tức',
				'text' => $firstError,
				'icon' => 'error'
			]);
		} catch (\Exception $e) {
			return redirect()->back()->with('toast', [
				'title' => 'Thất bại',
				'text' => 'Lỗi: ' . $e->getMessage(),
				'icon' => 'error'
			])->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show(News $news)
	{
		return view('pages.admin.news.show', compact('news'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(News $news)
	{
		$newsCategory = NewsCategory::all();
		return view('pages.admin.news.edit', compact('news', 'newsCategory'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, News $news)
	{
		try {
			$thumbnailPath = $news->thumbnail;
			if ($request->has('thumbnail') && !empty($request->thumbnail)) {
				$fileUrl = $request->thumbnail;
				$thumbnailPath = str_replace(['http://127.0.0.1:8000/storage/', '/storage/'], '', $fileUrl);
			}

			$request->merge([
				'slug' => Str::slug($request->title),
				'active' => $request->has('active'),
				'thumbnail' => $thumbnailPath,
				'user_id_updated' => Auth::id(),
			]);

			$validated = $request->validate([
				'title' => 'required|string|max:255|unique:news,title,' . $news->id,
				'slug' => 'required|string|max:255|unique:news,slug,' . $news->id,
				'excerpt' => 'required|string|max:255',
				'thumbnail' => 'required|string|max:255',
				'content' => 'required|string',
				'active' => 'boolean',
				'news_category_id' => 'required|exists:news_categories,id',
				'user_id_updated' => 'required|exists:users,id'
			]);

			$news->update($validated);

			return redirect()->back()->with('toast', [
				'title' => 'Cập nhật thành công',
				'text' => 'Tin tức đã được cập nhật',
				'icon' => 'success'
			]);
		} catch (ValidationException $e) {
			$firstField = array_key_first($e->errors());
			$firstError = $e->errors()[$firstField][0];

			return redirect()->back()->with('toast', [
				'title' => 'Lỗi cập nhật tin tức',
				'text' => $firstError,
				'icon' => 'error'
			]);
		} catch (\Exception $e) {
			return redirect()->back()->with('toast', [
				'title' => 'Đã xảy ra lỗi',
				'text' => $e->getMessage(),
				'icon' => 'error'
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(News $news)
	{
		try {
			$news->delete();
			return redirect()->route('dashboard.news')->with('toast', [
				'title' => 'Xóa tin tức',
				'text' => 'Xóa tin tức thành công',
				'icon' => 'success'
			]);
		} catch (\Exception $e) {
			return redirect()->route('dashboard.news')->with('toast', [
				'title' => 'Xóa tin tức',
				'text' => 'Xóa tin tức thất bại' . $e->getMessage(),
				'icon' => 'success'
			]);
		}
	}

	public function toggleActive(News $news)
	{
		try {
			$news->active = !$news->active;
			$news->save();
			return redirect()->route('dashboard.news')->with('toast', [
				'title' => 'Cập nhật trạng thái',
				'text' => 'Cập nhật trạng thái tin tức ' . $news->title . ' thành công',
				'icon' => 'success'
			]);
		} catch (\Exception $e) {
			return redirect()->route('dashboard.news')->with('toast', [
				'title' => 'Lỗi cập nhật trạng thái',
				'text' => $e->getMessage(),
				'icon' => 'error'
			]);
		}
	}
}
