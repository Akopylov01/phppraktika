<?php

namespace Controller;

use Model\Author;
use Model\Book;
use Src\Auth\Auth;
use Src\View;
use Model\Post;
use Model\Role;
use Src\Request;
use Model\User;
class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }
    public function posts(): string
    {
        $posts = Post::all();
        return (new View())->render('site.post', ['posts' => $posts]);
    }
    public function books(): string
    {
        $books = Book::all();
        return (new View())->render('site.books', ['books' => $books]);
    }

    public function signup(Request $request): string
    {
        if (!(app()->auth::check() && app()->auth::isAdmin())){
            app()->route->redirect('/login');
        }
        if ($request->method === 'POST' && User::create($request->all())) {

            app()->route->redirect('/hello');
        }
        $roles = Role::orderBy('id')->get();
        return new View('site.signup', ['roles' => $roles]);
    }

    public function addAuthor(Request $request): string
    {
        if (!(app()->auth::check() && app()->auth::isStuff())){
            app()->route->redirect('/login');
        }
        if ($request->method === 'POST' && Author::create($request->all())) {

            app()->route->redirect('/addAuthor');
        }
        $authors = Author::all();
        return new View('site.addAuthor', ['authors' => $authors]);
    }

    public function addBook(Request $request): string
    {
        if (!(app()->auth::check() && app()->auth::isStuff())){
            app()->route->redirect('/login');
        }
        if ($request->method === 'POST' && Book::create($request->all())) {

            app()->route->redirect('/hello');
        }
        $authors = Author::orderBy('id')->get();
        return new View('site.addBook', ['authors' => $authors]);
    }
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }


    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }
}

