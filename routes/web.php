<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('HomePage');
});

Route::get('/dang-nhap', function () {
	return view('pages.LoginPage');
})->name('LoginRoute');

Route::get('/dang-ky', function () {
	return view('pages.RegisterPage');
})->name('RegisterRoute');