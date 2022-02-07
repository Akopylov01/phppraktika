<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/addAuthor', [Controller\Site::class, 'addAuthor']);
Route::add(['GET', 'POST'], '/addBook', [Controller\Site::class, 'addBook']);
Route::add(['GET', 'POST'], '/delBook', [Controller\Site::class, 'deleteBook']);
Route::add(['GET', 'POST'], '/books', [Controller\Site::class, 'books']);


