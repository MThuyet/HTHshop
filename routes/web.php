<?php

use App\Http\Controllers;
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
Route::get('/', function () {
	return view('pages.client.HomePage');
})->name('home');

// ========================== SẢN PHẨM ========================== //
// Danh sách sản phẩm
Route::get('/san-pham', function () {
	return view('pages.client.ProductListPage');
})->name('product');

// Chi tiết sản phẩm
Route::get('/san-pham/slug', function () {
	return view('pages.client.ProductDetailPage');
})->name('product.detail');

// ========================== YÊU THÍCH ========================== //
Route::get('/yeu-thich', function () {
	return view('pages.client.FavoritePage');
})->name('favorite');

// ========================== GIỎ HÀNG ========================== //
Route::get('/gio-hang', function () {
	return view('pages.client.CartPage');
})->name('cart');

// ========================== ĐẶT HÀNG ========================== //
Route::get('/dat-hang', function () {
	return view('pages.client.OrderPage');
})->name('order');

// ========================== TIN TỨC ========================== //
// Danh sách tin tức
Route::get('/tin-tuc', function () {
	return view('pages.client.NewsPage');
})->name('news');

// Chi tiết tin tức
Route::get('/tin-tuc/slug', function () {
	return view('pages.client.NewsDetailPage');
})->name('news.detail');

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
	});
});
