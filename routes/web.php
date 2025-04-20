<?php

use App\Http\Controllers;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

// ========================== AUTH ========================== //
// Trang đăng nhập
Route::get('/dang-nhap', [Controllers\Auth\LoginController::class, 'showForm'])->name('login');
// Xử lý đăng nhập
Route::post('/dang-nhap', [Controllers\Auth\LoginController::class, 'handleLogin']);
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

// ========================== YÊU THÍCH ========================== //
Route::get('/yeu-thich', function () {
	return view('pages.client.FavoritePage');
})->name('favorite');

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
	Route::get('/danh-muc/{category_slug}', [Client\NewsController::class, 'index'])->name('news.category');

	// Chi tiết tin tức
	Route::get('/{news_slug}', [Client\NewsController::class, 'detail'])->name('news.detail');
});

// ========================== HỖ TRỢ ========================== //
Route::get('/ho-tro', function () {
	return view('pages.client.HelpPage');
})->name('help');

// ========================== LIÊN HỆ ========================== //
Route::get('/lien-he', function () {
	return view('pages.client.ContactPage');
})->name('contact');

// ========================== CHÍNH SÁCH ========================== //
Route::get('/chinh-sach', function () {
	return view('pages.client.PolicyPage');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Các route dành riêng cho admin, yêu cầu xác thực và có quyền admin.
*/

// Middleware `auth` => đã đăng nhập
Route::middleware(['auth'])->group(function () {

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
