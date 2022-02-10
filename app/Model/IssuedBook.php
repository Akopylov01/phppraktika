<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'date_issue',
        'date_return',
        'user_id',
    ];
    public $timestamps = false;
}

