<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class StuffMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь не авторизован, то редирект на страницу входа
        if (!(Auth::check() && Auth::isStuff())){
            app()->route->redirect('/login');
        }
    }
}
