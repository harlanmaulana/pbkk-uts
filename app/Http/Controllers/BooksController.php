<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BooksController extends Controller
{
    /**
     * Display a listing of all books.
     */
    public function index(): JsonResponse
    {
        return response()->json(Books::all());
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'isbn' => 'required|string',
            'publisher' => 'required|string',
            'year_published' => 'required|string',
            'stock' => 'required|integer',
        ]);

        // Generate ULID for book_id
        $validated['book_id'] = (string) Str::ulid();

        $book = Books::create($validated);

        return response()->json($book, 201);
    }

    /**
     * Display the specified book by ID.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $book = Books::findOrFail($id);
            return response()->json($book);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $book = Books::findOrFail($id);

            $validated = $request->validate([
                'title' => 'sometimes|required|string',
                'isbn' => 'sometimes|required|string',
                'publisher' => 'sometimes|required|string',
                'year_published' => 'sometimes|required|string',
                'stock' => 'sometimes|required|integer',
            ]);

            $book->update($validated);

            return response()->json($book);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $book = Books::findOrFail($id);
            $book->delete();

            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }
}
