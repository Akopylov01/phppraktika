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
    public function books(): string
    {
        $books = Book::all();
//        $book = Book::find(1);
//        foreach ($book->author as $auth){
//            file_put_contents('txt.txt', $auth->pivot->FIO);
//        }
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
        file_put_contents('txt.txt', $library_cards);
        return (new View())->render('site.library_card', ['library_cards' => $library_cards]);

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

