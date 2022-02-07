<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'author_id',
    ];
    public $timestamps = false;
}


