<?php

use Src\Route;
//->middleware('stuff'); ->middleware('admin');
Route::add('GET', '/', [Controller\Site::class, 'books']);
Route::add(['GET', 'POST'], '/signup', [Controller\Profile::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Profile::class, 'login']);
Route::add('GET', '/logout', [Controller\Profile::class, 'logout']);
Route::add(['GET', 'POST'], '/addAuthor', [Controller\Site::class, 'addAuthor'])->middleware('stuff');
Route::add(['GET', 'POST'], '/addBook', [Controller\Site::class, 'addBook'])->middleware('stuff');
Route::add(['GET', 'POST'], '/delBook', [Controller\Site::class, 'deleteBook'])->middleware('stuff');
Route::add(['GET', 'POST'], '/profile', [Controller\Profile::class, 'profile'])->middleware('auth');
Route::add(['GET', 'POST'], '/userList', [Controller\Site::class, 'userList'])->middleware('adminorstuff');
Route::add(['GET', 'POST'], '/library_card', [Controller\Site::class, 'library_card'])->middleware('adminorstuff');
Route::add(['GET', 'POST'], '/getBook', [Controller\Site::class, 'getBook']);




