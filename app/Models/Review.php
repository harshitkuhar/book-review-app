<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function books(){
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }


}
