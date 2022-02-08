<?php

use Src\Route;
//->middleware('stuff'); ->middleware('admin');
Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup'])->middleware('admin');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/addAuthor', [Controller\Site::class, 'addAuthor'])->middleware('stuff');
Route::add(['GET', 'POST'], '/addBook', [Controller\Site::class, 'addBook'])->middleware('stuff');
Route::add(['GET', 'POST'], '/delBook', [Controller\Site::class, 'deleteBook'])->middleware('stuff');
Route::add(['GET', 'POST'], '/books', [Controller\Site::class, 'books']);
Route::add(['GET', 'POST'], '/profile', [Controller\Site::class, 'profile'])->middleware('auth');


