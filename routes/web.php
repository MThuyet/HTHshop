<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('pages.HomePage');
});

Route::get('/dang-nhap', function () {
	return view('pages.LoginPage');
})->name('LoginRoute');

Route::get('/dang-ky', function () {
	return view('pages.RegisterPage');
})->name('RegisterRoute');

Route::get('/lien-he', function () {
	return view('pages.ContactPage');
});

Route::get('/tin-tuc', function () {
	return view('pages.NewsPage');
});

Route::get('/san-pham', function () {
	return view('pages.product.ProductListPage');
});

Route::get('/ho-tro', function () {
	return view('pages.HelpPage');
});

Route::get('/dat-hang', function () {
	return view('pages.OrderPage');
});
