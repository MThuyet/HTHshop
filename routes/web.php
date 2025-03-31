<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('pages.HomePage');
});

Route::get('/lien-he', function () {
	return view('pages.ContactPage');
});
