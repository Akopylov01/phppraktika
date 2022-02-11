<?php

namespace Controller;

use Model\Author;
use Src\Validator\Validator;
use Src\View;
use Src\Request;


class AuthorController
{
    public function addAuthor(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'FIO' => ['required', 'language','unique:authors,FIO']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'language' => 'Введите только русские символы',
            ]);
            if($validator->fails()){
                return new View('site.addAuthor',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            if(Author::create($request->all())) {
                app()->route->redirect('/addAuthor');
            }
        }
        $authors = Author::all();
        return new View('site.addAuthor', ['authors' => $authors]);
    }
}