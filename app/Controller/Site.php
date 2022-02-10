<?php

namespace Controller;

use Model\Author;
use Model\AuthorBook;
use Model\Book;
use Model\IssuedBook;
use Model\LibraryCard;
use Src\Auth\Auth;
use Src\View;
use Model\Post;
use Model\Role;
use Src\Request;
use Model\User;

class Site
{
    public function books(): string
    {
        $books = Book::all();
        $book = Book::all()->groupBy('title')->count();
        file_put_contents('txt.txt', $book);

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
        file_put_contents('txt.txt', $userId);
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
        if ($request->method === 'POST' && Book::create($request->all())) {
            $authorID = Book::where('author', $request->author)->value('author');
            $bookID = Book::where('title', $request->title)->value('id');
            $authorBook = AuthorBook::create([
                'author_id' => $authorID,
                'book_id' => $bookID,
            ]);
            $fileName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmpName, "uploads/".$fileName);
            file_put_contents('txt.txt', $fileName);
            app()->route->redirect('/');
        }
        $author = Author::orderBy('id')->get();

        return new View('site.addBook', ['auth' => $author]);
    }

    public function getBook(Request $request):string
    {
        $getingBook = Book::where('id', $request->id)->value('id');
        $user = Auth::user()->id;
        $date = date('Y-m-d');
        $issueBook = IssuedBook::create([
            'book_id' => $getingBook,
            'user_id' => $user,
            'date_issue' => $date,
        ]);
        file_put_contents('txt.txt', $getingBook);
        app()->route->redirect('/profile');
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

}

