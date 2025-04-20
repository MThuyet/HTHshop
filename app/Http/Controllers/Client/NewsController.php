<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
	// Danh sách tin tức theo danh mục
	public function index(Request $request, $category_slug = null)
	{
		$perPage = 6;

		$newsCategories = NewsCategory::whereHas('news')->select(['name', 'slug'])->get();

		if($category_slug && $category_slug != 'tin-tong-hop') {
			$currentCategory = NewsCategory::where('slug', $category_slug)->firstOrFail();

			if (!$currentCategory->news()->exists()) abort(404);

			$newsList = News::where('news_category_id', $currentCategory->id)
				->select(['title', 'slug', 'excerpt', 'thumbnail', 'created_at', 'news_category_id'])
				->with('category:id,name,slug')
				->orderBy('created_at', 'desc')
				->paginate($perPage);
		}else {
			$currentCategory = (object) ['name' => 'Tin tổng hợp'];

			$newsList = News::select(['title', 'slug', 'excerpt', 'thumbnail', 'created_at', 'news_category_id'])
				->with('category:id,name,slug')
				->orderBy('created_at', 'desc')
				->paginate($perPage); 
		}
		
		return view('pages.client.NewsPage', compact('newsCategories', 'currentCategory', 'newsList'));
	}

	// Chi tiết tin tức
	public function detail($news_slug)
	{
		$news = News::where('slug', $news_slug)->firstOrFail();
		return view('pages.client.NewsDetailPage', compact('news'));
	}
}
