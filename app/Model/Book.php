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
        'new',
        'cost',
        'annotation',
    ];
    public $timestamps = false;

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
