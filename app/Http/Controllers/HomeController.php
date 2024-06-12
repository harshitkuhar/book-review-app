<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // It will display homepage with all Books
    public function allBooks(){
        $books = Book::paginate(8);
        return view('home.books', compact('books'));
    }

    // It will display book detail page
    public function bookDetailPage($id){
        $book = Book::findOrFail($id);
        $relatedBooks = Book::whereNot('id', [$id])->take(3)->get();

        $reviews = Review::with('books', 'users')->whereIn('book_id' ,[$id])->get();

        $user_count = Review::with('books')->whereIn('book_id' ,[$id])->count();

        $rating = Review::with('books')->whereIn('book_id' ,[$id])->sum('rating');

        $final_rating = $rating/$user_count;

        return view('home.singlebook', ['book' => $book, 'relatedBooks' => $relatedBooks, 'reviews' => $reviews, 'final_rating' => $final_rating]);
    }

}
