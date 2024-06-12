<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::where('title', 'LIKE', '%'.$request->keyword.'%')->paginate(5);
        return view('book.list', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'required'
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $ext = $file->extension();
            $fileName = time() .'.'. $ext;
            $path = public_path('images/book');
            $file->move($path, $fileName);
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image' => $request->has('image') ? $fileName : null,
            'status' => $request->status
        ]);

        return redirect()->route('book.index')->with('message', 'Book added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $book = Book::findOrFail($book->id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $book = Book::findOrFail($book->id);
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'required'
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $ext = $file->extension();
            $fileName = time() .'.'. $ext;
            $path = public_path('images/book');
            $file->move($path, $fileName);

            $path = public_path('images/book/') . $book->image;

            if (file_exists($path)) {
                @unlink($path);
            }

        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image' => $request->has('image') ? $fileName : $book->image,
            'status' => $request->status
        ]);


        return redirect()->route('book.index')->with('message', 'Book Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book = Book::findOrFail($book->id);
        $book->delete();

        return redirect()->route('book.index')->with('message', 'Book deleted Successfully!');
    }
}
