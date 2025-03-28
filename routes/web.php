<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('HomePage');
});

Route::get('/tin-tuc', function () {
	return view('pages.NewsPage');
});