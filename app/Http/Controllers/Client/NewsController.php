<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
	// Danh sách tin tức theo danh mục
	public function index($category_slug)
	{
		$newsCategories = NewsCategory::all();
		$hotNews = News::orderBy('created_at', 'desc')->first();

		$category = NewsCategory::where('slug', $category_slug)->firstOrFail();
		$newsList = News::where('news_category_id', $category->id)->get();

		return view('pages.client.NewsPage', compact('newsCategories', 'hotNews', 'newsList'));
	}

	// Chi tiết tin tức
	public function detail($news_slug)
	{
		$news = News::where('slug', $news_slug)->firstOrFail();
		return view('pages.client.NewsDetailPage', compact('news'));
	}
}
