<?php

namespace Controller;

use Model\Author;
use Model\AuthorBook;
use Model\Book;
use Model\IssuedBook;
use Model\LibraryCard;
use Src\Auth\Auth;
use Src\Validator\Validator;
use Src\View;
use Model\Post;
use Model\Role;
use Src\Request;
use Model\User;

class Site
{
    public function popularBooks(): string
    {
        $issuedBooks = IssuedBook::select('book_id')->where('isActive', 1)->get();
        $books = Book::orderBy('count', 'DESC')->take(10)->whereNotIn('id', $issuedBooks)->get();
        return (new View())->render('site.popularBooks', ['books' => $books]);
    }

    public function books(): string
    {
        $issuedBooks = IssuedBook::select('book_id')->where('isActive', 1)->get();
        $books = Book::whereNotIn('id', $issuedBooks)->get();
        return (new View())->render('site.books', ['books' => $books]);
    }

    public function deleteBook(Request $request): string
    {
        Book::where('id', $request->id) -> delete();
        $books = Book::all();
        return (new View())->render('site.books', ['books' => $books]);

    }

    public function library_card(Request $request): string
    {
        $library_cards = LibraryCard::where('library_card_id', $request->login)->get();
        $userId = User::where('login', $request->login)->value('id');
        $issuedBook = IssuedBook::where('user_id', $userId)->get();
        return (new View())->render('site.library_card', ['library_cards' => $library_cards, 'issuedBook'=>$issuedBook]);

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
        if ($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'image' => ['image'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'image' => 'Допустимые типы файлов - jpg, jpeg, png',
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            $fileName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $path = 'upload';
            move_uploaded_file($tmpName, $path .'/'. $fileName);
            file_put_contents('txt.txt', $path);
            if (Book::create($request->all())) {
                $authorID = Book::where('author', $request->author)->value('author');
                $bookID = Book::where('title', $request->title)->value('id');
                $authorBook = AuthorBook::create([
                    'author_id' => $authorID,
                    'book_id' => $bookID,
                ]);
                Book::where('id', $bookID)->update(['image' => $fileName]);
                app()->route->redirect('/');
                }

        }
        $author = Author::orderBy('id')->get();
        return new View('site.addBook', ['auth' => $author]);
    }
    public function searchBook(Request $request):string
    {
            $search = $request->search;
            $books = Book::where('title', $search)->orWhere('genre', $search)->get();
            file_put_contents('txt.txt', $search);

            return (new View())->render('site.books', ['books' => $books]);
    }
    public function getBook(Request $request):string
    {
        $books = Book::all();
        $getingBookCount = Book::where('id', $request->id)->value('count');
        $getingBookId = Book::where('id', $request->id)->value('id');
        $user = Auth::user()->id;
        $date = date('Y-m-d');
        $issueBook = IssuedBook::create([
            'book_id' => $getingBookId,
            'user_id' => $user,
            'date_issue' => $date,
            'isActive' => 1,
        ]);
        $getingBookCount += 1;
        Book::where('id', $getingBookId)->update(['count' => $getingBookCount]);
        app()->route->redirect('/books');

        return (new View())->render('site.books', ['books' => $books]);
    }

    public function userList(): string
    {
        if (Auth::check() && Auth::isStuff()) {
            $profiles = User::where('role', 3)->get();
        }
        else if(Auth::check() && Auth::isAdmin()){
            $profiles = User::all();
        }
        return (new View())->render('site.userList', ['profiles' => $profiles]);

    }
    public function comebackBook(Request $request):string
    {
        if (Auth::check() && Auth::isStuff()) {
            $profiles = User::where('role', 3)->get();
        }
        else if(Auth::check() && Auth::isAdmin()){
            $profiles = User::all();
        }
        $getingIssueBook = IssuedBook::where('id', $request->id)->value('id');
        $date = date('Y-m-d');
        IssuedBook::where('id', $getingIssueBook)->update(['date_return' => $date, 'isActive'=> 0]);
        return (new View())->render('site.userList', ['profiles' => $profiles]);
    }
}

