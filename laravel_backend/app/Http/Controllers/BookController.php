<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        if ($books->isEmpty()) {
            $bookdata = [
                'message' => 'No books found',
                'data' => []
            ];
            return response()->json($bookdata, 404);
        } else {
            $bookdata = [
                'message' => 'Books retrieved successfully',
                'data' => $books
            ];
        }
        return response()->json($bookdata, 200);
    }

    /**
     * create a new book resource.
     */
    public function create(Request $request)
    {
        $book = Book::create([
            'ISBN' => $request->ISBN,
            'image' => $request->image,
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'publication_year' => $request->publication_year,
            'available_copies' => $request->available_copies
        ]);

        if (!$book) {
            $bookdata = [
                'message' => 'Failed to create book',
            ];
            return response()->json($bookdata, 500);
        }

        $bookdata = [
            'message' => 'Book created successfully',
            'data' => $book
        ];
        return response()->json($bookdata, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::find($id);
        if ($book) {
            $bookdata = [
                'message' => 'Book retrieved successfully',
                'data' => $book
            ];
            return response()->json($bookdata, 200);
        } else {
            $bookdata = [
                'message' => 'Book not found',
                'data' => null
            ];
            return response()->json($bookdata, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, $id)
    {
        $book = Book::where('id', $id)
            ->update([
                'ISBN' => $request->ISBN,
                'image' => $request->image,
                'title' => $request->title,
                'author' => $request->author,
                'category' => $request->category,
                'publication_year' => $request->publication_year,
                'available_copies' => $request->available_copies
            ]);
        if ($book) {
            $bookdata = [
                'message' => 'Book updated successfully',
            ];
            return response()->json($bookdata, 200);
        } else {
            $bookdata = [
                'message' => 'Failed to update book',
            ];
            return response()->json($bookdata, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        if ($book) {
            $bookdata = [
                'message' => 'Book deleted successfully',
            ];
            return response()->json($bookdata, 200);
        } else {
            $bookdata = [
                'message' => 'Failed to delete book',
            ];
            return response()->json($bookdata, 500);
        }
    }
}
