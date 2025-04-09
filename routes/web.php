<?php

use Illuminate\Support\Facades\Route;

// home
Route::get('/', function () {
	return view('pages.HomePage');
});

// login - register
Route::get('/dang-nhap', function () {
	return view('pages.LoginPage');
})->name('LoginRoute');

Route::get('/dang-ky', function () {
	return view('pages.RegisterPage');
})->name('RegisterRoute');

// contact
Route::get('/lien-he', function () {
	return view('pages.ContactPage');
});

// news
Route::get('/tin-tuc', function () {
	return view('pages.NewsPage');
});

// news detail
Route::get('/tin-tuc/slug', function () {
	return view('pages.NewsDetailPage');
})->name('news.detail');

// product
Route::get('/san-pham', function () {
	return view('pages.product.ProductListPage');
});

// product detail
Route::get('/san-pham/slug', function () {
	return view('pages.product.ProductDetailPage');
});

// help
Route::get('/ho-tro', function () {
	return view('pages.HelpPage');
});

// policy
Route::get('/chinh-sach', function () {
	return view('pages.PolicyPage');
});

// cart
Route::get('/gio-hang', function () {
	return view('pages.CartPage');
})->name('cart.index');

// order
Route::get('/dat-hang', function () {
	return view('pages.OrderPage');
});
