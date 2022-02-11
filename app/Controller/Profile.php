<?php

namespace Controller;

use Model\Book;
use Model\IssuedBook;
use Model\LibraryCard;
use Src\Auth\Auth;
use Src\Validator\Validator;
use Src\View;
use Model\Role;
use Src\Request;
use Model\User;

class Profile
{
    public function profile(): string
    {
        $profile_id = Auth::user()->id;
        $profile = User::where('id', $profile_id)->get();
        $issuedBook = IssuedBook::where('user_id', $profile_id)->get();
        $issuedBookId = IssuedBook::select('book_id')->where('user_id', $profile_id)->get();
        $books = Book::whereIn('id', $issuedBookId)->get();
        return (new View())->render('site.profile', ['profile' => $profile, 'issuedBook'=>$issuedBook, 'books'=>$books]);

    }
    public function searchUser(Request $request):string
    {
        $search = $request->search;
        $profiles = User::where('login', $search)->get();
        return (new View())->render('site.userList', ['profiles' => $profiles]);
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

    public function library_card(Request $request): string
    {
        $library_cards = LibraryCard::where('library_card_id', $request->login)->get();
        $userId = User::where('login', $request->login)->value('id');
        $issuedBook = IssuedBook::where('user_id', $userId)->get();
        $issuedBookId = IssuedBook::select('book_id')->where('user_id', $userId)->get();
        $books = Book::whereIn('id', $issuedBookId)->get();
        return (new View())->render('site.library_card', ['library_cards' => $library_cards, 'issuedBook'=>$issuedBook, 'books'=>$books]);

    }
    public function signup(Request $request): string
    {
        $message = ' ';
        $flag ='';
        if (Auth::check() && Auth::isAdmin()) {
            $flag = True;
        }
        if ($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'address' => ['required','language'],
                'phone' => ['required',],
                'FIO' => ['required', 'language','unique:users,FIO'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'language' => 'Введите только русские символы'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $date = date('Y-m-d');
            $lib = LibraryCard::create([
                'library_card_id' => rand(89999999, 99999999),
                'date_issued' => $date,
                'isActive' => 1,
            ]);
            $newLib = $lib->library_card_id;
            $random_string = User::getPassword();
            $user = User::create(
                [
                    'password'=>$random_string,
                    'login' => $newLib,
                    'phone' => $request->phone,
                    'FIO' => $request->FIO,
                    'role' => $request->role,
                    'address' => $request->address,
                ]);

            $message = 'Пользователь успешно добавлен его логин - ' . $newLib . ' Пароль - ' . $random_string;

        }
        $roles = Role::orderBy('id')->get();
        return new View('site.signup', ['roles' => $roles, 'message' => $message, 'flag'=> $flag]);


    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }


}
