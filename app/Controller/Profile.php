<?php

namespace Controller;

use Model\LibraryCard;
use Src\Auth\Auth;
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
        return (new View())->render('site.profile', ['profile' => $profile]);

    }

    public function signup(Request $request): string
    {
        $message = ' ';
        $flag ='';
        if (Auth::check() && Auth::isAdmin()) {
            $flag = True;
        }
        if ($request->method === 'POST'){

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $input_length = strlen($permitted_chars);
            $random_string = '';
            for ($i = 0; $i < 8; $i++) {
                $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
            $date = date('Y-m-d');
            $lib = LibraryCard::create([
                'library_card_id' => rand(89999999, 99999999),
                'date_issued' => $date,
                'isActive' => 1,
            ]);
            $newLib = $lib->library_card_id;
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
            file_put_contents('txt.txt', $message);

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
