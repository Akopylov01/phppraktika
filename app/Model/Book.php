<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'image',
        'title',
        'genre',
        'category',
        'year',
        'isNew',
        'cost',
        'annotation',
    ];
    public $timestamps = false;
}
