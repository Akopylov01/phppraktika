<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'library_card_id',
        'date_issued',
    ];
    public $timestamps = false;
}