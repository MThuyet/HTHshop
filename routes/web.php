<?php

use App\Http\Controllers;
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
Route::get('/dang-nhap', [Controllers\Auth\LoginController::class, 'showForm'])->name('login');
Route::post('/dang-nhap', [Controllers\Auth\LoginController::class, 'handleLogin'])->name('handle-login');
Route::get('/dang-xuat', [Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ========================== HOME ========================== //
Route::get('/', [Client\HomeController::class, 'index'])->name('home');

// ========================== PRODUCT ========================== //
// Danh sách sản phẩm & filter
Route::match(['get', 'post'], '/san-pham', [Client\ProductCategoriesController::class, 'index'])->name('product');

// Chi tiết sản phẩm
Route::get('/san-pham/{product_slug}', [Client\ProductDetailsController::class, 'index'])->name('product.detail');
Route::post('/upload-image', [Client\ProductDetailsController::class, 'uploadImage'])->name('upload.image');
Route::post('/products/{product_slug}/reviews', [Client\ProductDetailsController::class, 'storeReview'])->name('reviews.store');

// ========================== WISH LIST ========================== //
Route::get('/yeu-thich', function () {return view('pages.client.FavoritePage');})->name('favorite');

// ========================== CART ========================== //
Route::get('/gio-hang', function () {return view('pages.client.CartPage');})->name('cart');

// ========================== ORDER ========================== //
Route::get('/dat-hang', [Client\OrdersController::class, 'index'])->name('order');
Route::post('/dat-hang', [Client\OrdersController::class, 'store'])->name('order.store');

// ========================== NEWS ========================== //
Route::prefix('tin-tuc')->group(function () {
	Route::get('/danh-muc/{category_slug?}', [Client\NewsController::class, 'index'])->name('news.category');
	Route::get('/{news_slug}', [Client\NewsController::class, 'detail'])->name('news.detail');
});

// ========================== HỖ TRỢ ========================== //
Route::get('/ho-tro', function () {return view('pages.client.HelpPage');})->name('help');

// ========================== CONTACT ========================== //
Route::get('/lien-he', [Client\ContactController::class, 'showForm'])->name('contact.show-form');
Route::post('/lien-he', [Client\ContactController::class, 'submitForm'])->name('contact.submit-form')->middleware('throttle:2,5');

// ========================== CHÍNH SÁCH ========================== //
Route::get('/chinh-sach', function () {return view('pages.client.PolicyPage');});

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

	// ========================== NEWS CATEGORIES ========================== //
	Route::resource('/dashboard/news-categories', Admin\NewsCategoriesController::class)->names([
		'index' => 'dashboard.news-categories',
		'show' => 'dashboard.news-categories.show',
		'create' => 'dashboard.news-categories.create',
		'store' => 'dashboard.news-categories.store',
		'edit' => 'dashboard.news-categories.edit',
		'update' => 'dashboard.news-categories.update',
		'destroy' => 'dashboard.news-categories.delete'
	]);

	Route::put('/dashboard/news-categories/{newsCategory}/toggle', [Admin\NewsCategoriesController::class, 'toggleActive'])->name('dashboard.news-categories.toggle');

	// ========================== EDITOR ========================== //
	Route::group(['prefix' => 'laravel-filemanager'], function () {Lfm::routes();});

	// Middleware `auth.admin` => là admin
	Route::middleware(['auth.admin'])->group(function () {

		// ========================== DASHBOARD ========================== //
		Route::get('/admin/dashboard', function () {return view('pages.admin.dashboard');})->name('admin.dashboard');

		// ========================== PRODUCT CATEGORIES ========================== //
		Route::resource('/admin/product-categories', Admin\ProductCategoriesController::class)->names([
			'index' => 'admin.product-categories',
			'show' => 'admin.product-categories.show',
			'create' => 'admin.product-categories.create',
			'store' => 'admin.product-categories.store',
			'edit' => 'admin.product-categories.edit',
			'update' => 'admin.product-categories.update',
			'destroy' => 'admin.product-categories.delete'
		]);

		Route::put('/admin/product-categories/{productCategory}/toggle', [Admin\ProductCategoriesController::class, 'toggleActive'])->name('admin.product-categories.toggle');

		// ========================== PRODUCTS ========================== //
		Route::resource('/admin/products', Admin\ProductsController::class)->names([
			'index' => 'admin.products',
			'show' => 'admin.products.show',
			'create' => 'admin.products.create',
			'store' => 'admin.products.store',
			'edit' => 'admin.products.edit',
			'update' => 'admin.products.update',
			'destroy' => 'admin.products.delete'
		]);

		// active
		Route::put('/admin/products/{product}/toggle', [Admin\ProductsController::class, 'toggleActive'])
		->name('admin.products.toggle');

		// customization
		Route::put('/admin/products/{product}/toggle-customization', [Admin\ProductsController::class, 'toggleCustomization'])->name('admin.products.toggle-customization');

		// delete image
		Route::delete('/admin/products/image/{image}', [Admin\ProductsController::class, 'deleteImage'])
		->name('admin.products.image.delete');

		// ========================== ORDERS ========================== //
		Route::resource('/admin/orders', Admin\OrdersController::class)->names([
			'index' => 'admin.orders',
			'show' => 'admin.orders.show',
			'create' => 'admin.orders.create',
			'store' => 'admin.orders.store',
			'edit' => 'admin.orders.edit',
			'update' => 'admin.orders.update',
			'destroy' => 'admin.orders.delete'
		]);

		// ========================== USERS ========================== //
		Route::resource('/admin/users', Admin\UsersController::class)->names([
			'index' => 'admin.users',
			'show' => 'admin.users.show',
			'create' => 'admin.users.create',
			'store' => 'admin.users.store',
			'edit' => 'admin.users.edit',
			'update' => 'admin.users.update',
			'destroy' => 'admin.users.delete'
		]);

		Route::put('/admin/users/{user}/toggle', [Admin\UsersController::class, 'toggleActive'])->name('admin.users.toggle');

	});
});
