<?php

namespace Controller;

use Model\Author;
use Src\View;
use Src\Request;


class AuthorController
{
    public function addAuthor(Request $request): string
    {
        if ($request->method === 'POST' && Author::create($request->all())) {

            app()->route->redirect('/addAuthor');
        }
        $authors = Author::all();
        return new View('site.addAuthor', ['authors' => $authors]);
    }
}