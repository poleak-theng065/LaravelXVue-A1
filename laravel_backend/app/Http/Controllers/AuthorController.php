<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = Author::all();
        if ($author->isEmpty()) {
            $authordata = [
                'message' => 'No $authors found',
                'data' => []
            ];
            return response()->json($authordata, 404);
        } else {
            $authordata = [
                'message' => '$authors retrieved successfully',
                'data' => $author
            ];
        }
        return response()->json($authordata, 200);
    }

    /**
     * create a new book resource.
     */
    public function create(Request $request)
    {
        $author = Author::create([
            'name' => $request->name,
            'nationality' => $request->nationality,
            'writen_book' => $request->writen_book,
        ]);

        if (!$author) {
            $authordata = [
                'message' => 'Failed to create author$author',
            ];
            return response()->json($authordata, 500);
        }

        $authordata = [
            'message' => 'author$author created successfully',
            'data' => $author
        ];
        return response()->json($authordata, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = Author::find($id);
        if ($author) {
            $authordata = [
                'message' => 'Author retrieved successfully',
                'data' => $author
            ];
            return response()->json($authordata, 200);
        } else {
            $authordata = [
                'message' => 'Author not found',
                'data' => null
            ];
            return response()->json($authordata, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, $id)
    {
        $author = Author::where('id', $id)
            ->update([
                'name' => $request->name,
                'nationality' => $request->nationality,
                'writen_book' => $request->writen_book,
            ]);
        if ($author) {
            $authordata = [
                'message' => 'Author updated successfully',
            ];
            return response()->json($authordata, 200);
        } else {
            $authordata = [
                'message' => 'Failed to update author$author',
            ];
            return response()->json($authordata, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if ($author) {
            $author->delete();
            $authordata = [
                'message' => 'Author deleted successfully',
            ];
            return response()->json($authordata, 200);
        } else {
            $authordata = [
                'message' => 'Failed to delete author',
            ];
            return response()->json($authordata, 500);
        }
    }
}
