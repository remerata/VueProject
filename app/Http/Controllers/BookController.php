<?php

// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Assuming you have a Book model

class BookController extends Controller
{
    public function store(Request $request)
    {
        // Basic validation (optional)
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'bookId' => 'required|string|unique:books',
            'publicationDate' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Create the book record
        $book = Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'bookId' => $validated['bookId'],
            'publicationDate' => $validated['publicationDate'],
            'description' => $validated['description'],
        ]);

        // Return success response
        return response()->json(['message' => 'Book added successfully!', 'book' => $book], 201);
    }
    public function addBook(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'bookId' => 'required|string|max:255',
            'publicationDate' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Create the new book entry
        $book = Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'book_id' => $validated['bookId'],
            'publication_date' => $validated['publicationDate'],
            'description' => $validated['description'],
        ]);

        // Return a success response
        return response()->json(['message' => 'Book added successfully', 'book' => $book], 201);
    }
}

