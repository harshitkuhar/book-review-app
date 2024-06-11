<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('books', 'users')->paginate(5);
        return view('review.list', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        //return $userId;
        $validate = Validator::make($request->all(),[
            'review' => 'required',
            'rating' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->route('home.singlebook', $request->book_id . '#review')->withErrors($validate);
        }

        Review::create([
            'review' => $request->review,
            'rating' => $request->rating,
            'book_id' => $request->book_id,
            'user_id' => $userId
        ]);

        return redirect()->route('home.singlebook', $request->book_id)->with('message', 'Review added successfully!');
    }

    /**
     * Display My reviews (logged in users ke sare reviews).
     */
    public function show(Review $review, String $user_id)
    {
        $reviews = Review::where('user_id', $user_id)->paginate(5);
        //return $reviews;
        return view('review.my', compact('reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $review = Review::findOrFail($review->id);
        return view('review.edit', compact('review'));
    }

    /**
     * Show the form for editing My review
     */
    public function showEdit($id)
    {
        $review = Review::findOrFail($id);
        return view('review.myedit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $review = Review::findOrFail($review->id);
        $review->update([
            'status' => $request->status,
        ]);

        return redirect()->route('review.index')->with('message', 'Review updated successfully!');
    }

    /**
     * Update the My Review in storage.
     */
    public function updateMyReview(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->update([
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->route('review.my', Auth::user()->id)->with('message', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
