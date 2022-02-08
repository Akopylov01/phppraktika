<?php

namespace Controller;

use Model\Author;
use Model\AuthorBook;
use Model\Book;
use Model\LibraryCard;
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

    public function profile(): string
    {
        $profile_id = Auth::user()->id;
        $profile = User::where('id', $profile_id)->get();
        file_put_contents('txt.txt', $profile);
        return (new View())->render('site.profile', ['profile' => $profile]);

    }

    public function books(): string
    {
        $books = Book::all();
//        $book = Book::find(1);
//        foreach ($book->author as $auth){
//            file_put_contents('txt.txt', $auth->pivot->FIO);
//        }
        return (new View())->render('site.books', ['books' => $books]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST'){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $input_length = strlen($permitted_chars);
            $random_string = '';
            for ($i = 0; $i < 11; $i++) {
                $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }

            $date = date('Y-m-d');
            $lib = LibraryCard::create([
                'library_card_id' => $random_string,
                'date_issued' => $date,
            ]);
            $newLib = $lib->library_card_id;
            $user = User::create(
                [
                'password'=>$request->password,
                'login' => $newLib,
                'phone' => $request->phone,
                'FIO' => $request->FIO,
                'role' => $request->role,
                'address' => $request->address,
            ]);

//          $user = User::where('FIO', $request->all()['FIO'])->first();
            app()->route->redirect('/books');
            }
        $roles = Role::orderBy('id')->get();
        return new View('site.signup', ['roles' => $roles]);


    }

    public function deleteBook(Request $request): string
    {
        Book::where('id', $request->id) -> delete();
        $books = Book::all();
        return (new View())->render('site.books', ['books' => $books]);

    }

    public function addAuthor(Request $request): string
    {
        if ($request->method === 'POST' && Author::create($request->all())) {

            app()->route->redirect('/addAuthor');
        }
        $authors = Author::all();
        return new View('site.addAuthor', ['authors' => $authors]);
    }

    public function addBook(Request $request): string
    {
        if ($request->method === 'POST' && Book::create($request->all())) {
            $authorId = Book::where('author', $request->author)->value('author');
            $bookId = Book::where('author', $request->author)->value('id');
            $authorBook = AuthorBook::create([
                'book_id' => $bookId,
                'author_id' => $authorId,
            ]);
            file_put_contents('txt.txt', $authorId);
            app()->route->redirect('/books');
        }
        $authors = AuthorBook::orderBy('author_id')->get();
        $author = Author::orderBy('id')->get();
        file_put_contents('txt.txt', $author);

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
            app()->route->redirect('/books');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/books');
    }


}

