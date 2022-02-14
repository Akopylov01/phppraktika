<?php

namespace Controller;

use ErrorException;
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
        $booksId = Book::whereNotIn('id', $issuedBooks)->get('author');
        $author = Author::whereIn('id', $booksId)->get();
        return (new View())->render('site.popularBooks', ['books' => $books,'author'=>$author]);
    }

    public function books(): string
    {
        $issuedBooks = IssuedBook::select('book_id')->where('isActive', 1)->get();
        $books = Book::whereNotIn('id', $issuedBooks)->get();
        $booksId = Book::whereNotIn('id', $issuedBooks)->get('author');
        $author = Author::whereIn('id', $booksId)->get();
        file_put_contents('txt.txt', $author);
        return (new View())->render('site.books', ['books' => $books, 'author'=>$author]);
    }

    public function deleteBook(Request $request): string
    {
        Book::where('id', $request->id) -> delete();
        $books = Book::all();
        app()->route->redirect('/books');

        return (new View())->render('site.books', ['books' => $books]);

    }
    public function editBook(Request $request): string
    {
        Book::where('id', $request->id) -> delete();
        $books = Book::all();
        app()->route->redirect('/books');

        return (new View())->render('site.books', ['books' => $books]);

    }
    public function addBook(Request $request): string
    {
//        if (!isset($request->all()['author'])){
//            $request->all()['author'] =' ';
//        }
        $author = Author::orderBy('id')->get();

        if ($request->method === 'POST'){
            $fileName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $errors = $_FILES['image']['error'];
            if ($errors > 0) {
                return new View('site.addBook',
                    ['message' => 'Загрузите изображение', 'auth' => $author]);
            }
            $path = 'upload';
            move_uploaded_file($tmpName, $path .'/'. $fileName);
            $validator = new Validator($request->all(), [
                'author' => ['required'],
                'title' => ['required','language','unique:books,title'],
                'genre' => ['required', 'language'],
                'category' => ['required', 'language'],
                'new' => ['required'],
                'annotation' => ['required', 'language'],
                'year' => ['date','required'],
                'image' => ['image','required']
            ], [
                'unique' => 'Поле должно быть уникально',
                'required' => 'Поле :field пусто',
                'language' => 'Введите только русские символы',
                'date' => 'Введите корректную дату',
                'image' => 'Загрузите корректное изображение, допустимые типы jpg, jpeg, png'
            ]);
            if($validator->fails()){
                return new View('site.addBook',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'auth' => $author]);
            }

            if (Book::create($request->all())) {
                $authorID = Book::where('author', $request->author)->value('author');
                $bookID = Book::where('title', $request->title)->value('id');
                Book::where('id', $bookID)->update(['image' => $fileName]);
                app()->route->redirect('/');
            }
        }
        return new View('site.addBook', ['auth' => $author]);
    }

    public function searchBook(Request $request):string
    {
            $search = $request->search;
            $author = Author::where('FIO', $search)->get();
            $authorId = Author::where('FIO', $search)->get('id');
            $books = Book::where('title', $search)->orWhere('genre', $search)->orWhereIn('author', $authorId)->get();
            return (new View())->render('site.books', ['books' => $books, 'author'=>$author]);
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
}

