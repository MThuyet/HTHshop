<?php

use App\Http\Controllers;
use App\Http\Controllers\Client\ProductController;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Client;
use Illuminate\Support\Facades\Route;
use \UniSharp\LaravelFilemanager\Lfm;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

// ========================== AUTH ========================== //
// Trang đăng nhập
Route::get('/dang-nhap', [Controllers\Auth\LoginController::class, 'showForm'])->name('login')->middleware('guest');;
// Xử lý đăng nhập
Route::post('/dang-nhap', [Controllers\Auth\LoginController::class, 'handleLogin'])->name('handle-login');
// Đăng xuất
Route::get('/dang-xuat', [Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ========================== TRANG CHỦ ========================== //
Route::get('/', [Client\HomeController::class, 'index'])->name('home');

// ========================== SẢN PHẨM ========================== //
// Danh sách sản phẩm & filter
Route::match(['get', 'post'], '/san-pham', [Client\ProductCategoryController::class, 'index'])->name('product');

// Chi tiết sản phẩm
Route::get('/san-pham/{product_slug}', [Client\ProductDetailController::class, 'index'])->name('product.detail');
Route::post('/upload-image', [Client\ProductDetailController::class, 'uploadImage'])->name('upload.image');
Route::post('/products/{product_slug}/reviews', [Client\ProductDetailController::class, 'storeReview'])->name('reviews.store');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/products/toggle-favorite', [ProductController::class, 'toggleFavorite']);
Route::get('/products', [ProductController::class, 'getProductsByIds']); 
// ========================== YÊU THÍCH ========================== //
Route::get('/yeu-thich', function () {
	return view('pages.client.FavoritePage');
})->name('favorite');

// API dự phòng cho truy xuất sản phẩm yêu thích (trong trường hợp API routes không hoạt động)
Route::get('/api-web/products', [Client\ProductController::class, 'getProductsByIds']);
Route::get('/api-web/products/debug', [Client\ProductController::class, 'debugFavoriteProducts']);
Route::post('/api-web/products/toggle-favorite', [Client\ProductController::class, 'toggleFavorite']);

// Debug Page
Route::get('/api-test', function() {
    return view('pages.client.ApiTestPage');
})->name('api.test');

// ========================== GIỎ HÀNG ========================== //
Route::get('/gio-hang', function () {
	return view('pages.client.CartPage');
})->name('cart');

// ========================== ĐẶT HÀNG ========================== //
Route::get('/dat-hang', [Client\OrderController::class, 'index'])->name('order');
Route::post('/dat-hang', [Client\OrderController::class, 'store'])->name('order.store');

// ========================== TIN TỨC ========================== //
Route::prefix('tin-tuc')->group(function () {
	// Danh sách theo danh mục
	Route::get('/danh-muc/{category_slug?}', [Client\NewsController::class, 'index'])->name('news.category');

	// Chi tiết tin tức
	Route::get('/{news_slug}', [Client\NewsController::class, 'detail'])->name('news.detail');
});

// ========================== HỖ TRỢ ========================== //
Route::get('/ho-tro', function () {
	return view('pages.client.HelpPage');
})->name('help');

// ========================== CONTACT ========================== //
Route::get('/lien-he', [Client\ContactController::class, 'showForm'])->name('contact.show-form');
Route::post('/lien-he', [Client\ContactController::class, 'submitForm'])->name('contact.submit-form')->middleware('throttle:2,5');

// ========================== CHÍNH SÁCH ========================== //
Route::get('/chinh-sach', function () {
	return view('pages.client.PolicyPage');
});

// Route để reset session yêu thích
Route::get('/reset-favorite-session', function(Request $request) {
    $request->session()->forget('favoriteProducts');
    $request->session()->forget('likedProductsSession');
    return redirect()->back()->with('success', 'Đã reset session yêu thích');
});

// Route để kiểm tra session yêu thích
Route::get('/check-favorite-session', function(Request $request) {
    $favoriteProducts = json_decode($request->session()->get('favoriteProducts', '[]'), true);
    $likedProductsSession = json_decode($request->session()->get('likedProductsSession', '[]'), true);
    
    return response()->json([
        'favoriteProducts' => $favoriteProducts,
        'likedProductsSession' => $likedProductsSession
    ]);
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Các route dành riêng cho admin, yêu cầu xác thực và có quyền admin.
*/

// Middleware `auth` => đã đăng nhập
Route::middleware(['auth'])->group(function () {

	/* Các route dùng chung của admin và staff. */
	// ========================== USERS ========================== //
	Route::get('/dashboard/profile', [Controllers\ProfileController::class, 'edit'])->name('dashboard.profile.edit');
	Route::put('/dashboard/profile', [Controllers\ProfileController::class, 'update'])->name('dashboard.profile.update');

	// ========================== NEWS ========================== //
	Route::resource('/dashboard/news', Admin\NewsController::class)->names([
		'index' => 'dashboard.news',
		'show' => 'dashboard.news.show',
		'create' => 'dashboard.news.create',
		'store' => 'dashboard.news.store',
		'edit' => 'dashboard.news.edit',
		'update' => 'dashboard.news.update',
		'destroy' => 'dashboard.news.delete'
	]);

	Route::put('/dashboard/news/{news}/toggle', [Admin\NewsController::class, 'toggleActive'])->name('dashboard.news.toggle');

	// ========================== NEWS CATEGORY ========================== //
	Route::resource('/dashboard/news-category', Admin\NewsCategoryController::class)->names([
		'index' => 'dashboard.news-category',
		'show' => 'dashboard.news-category.show',
		'create' => 'dashboard.news-category.create',
		'store' => 'dashboard.news-category.store',
		'edit' => 'dashboard.news-category.edit',
		'update' => 'dashboard.news-category.update',
		'destroy' => 'dashboard.news-category.delete'
	]);

	Route::put('/dashboard/news-category/{newsCategory}/toggle', [Admin\NewsCategoryController::class, 'toggleActive'])->name('dashboard.news-category.toggle');

	// ========================== EDITOR ========================== //
	Route::group(['prefix' => 'laravel-filemanager'], function () {
		Lfm::routes();
	});

	// Middleware `auth.admin` => là admin
	Route::middleware(['auth.admin'])->group(function () {

		// ========================== DASHBOARD ========================== //
		Route::get('/admin/dashboard', function () {
			return view('pages.admin.dashboard');
		})->name('admin.dashboard');

		// ========================== PRODUCT ========================== //
		Route::get('/admin/product', function () {
			return view('pages.admin.product.index');
		})->name('admin.product');

		Route::get('/admin/product/create', function () {
			return view('pages.admin.product.create');
		})->name('admin.product.create');

		Route::get('/admin/product/update/{id}', function ($id) {
			return view('pages.admin.product.update', ['id' => $id]);
		})->name('admin.product.update');

		// ========================== PRODUCT CATEGORY ========================== //
		Route::get('/admin/product-category', function () {
			return view('pages.admin.product-category.index');
		})->name('admin.product-category');

		Route::get('/admin/product-category/create', function () {
			return view('pages.admin.product-category.create');
		})->name('admin.product-category.create');

		// ========================== USERS ========================== //
		Route::resource('/admin/users', Admin\UserController::class)->names([
			'index' => 'admin.user',
			'show' => 'admin.user.show',
			'create' => 'admin.user.create',
			'store' => 'admin.user.store',
			'edit' => 'admin.user.edit',
			'update' => 'admin.user.update',
			'destroy' => 'admin.user.delete'
		]);

		Route::put('/admin/users/{user}/toggle', [Admin\UserController::class, 'toggleActive'])->name('admin.user.toggle');

	});
});