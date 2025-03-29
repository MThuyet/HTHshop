<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('HomePage');
});

Route::get('/lien-he', function () {
	return view('pages.ContactPage');
});