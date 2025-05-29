<?php

namespace App\Http\Controllers;

use App\Models\BookAuthors;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookAuthorsController extends Controller
{
    /**
     * Display a listing of the book-author relationships.
     */
    public function index(): JsonResponse
    {
        $data = BookAuthors::with(['book', 'author'])->get();
        return response()->json($data);
    }

    /**
     * Store a newly created book-author relationship.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,book_id',
            'author_id' => 'required|exists:authors,author_id',
        ]);

        $bookAuthor = BookAuthors::create($validated);

        return response()->json($bookAuthor, 201);
    }

    /**
     * Display the specified book-author relationship.
     */
    public function show($id): JsonResponse
    {
        $bookAuthor = BookAuthors::with(['book', 'author'])->findOrFail($id);
        return response()->json($bookAuthor);
    }

    /**
     * Update the specified book-author relationship.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $bookAuthor = BookAuthors::findOrFail($id);

        $validated = $request->validate([
            'book_id' => 'sometimes|required|exists:books,book_id',
            'author_id' => 'sometimes|required|exists:authors,author_id',
        ]);

        $bookAuthor->update($validated);

        return response()->json($bookAuthor);
    }

    /**
     * Remove the specified book-author relationship.
     */
    public function destroy($id): JsonResponse
    {
        $bookAuthor = BookAuthors::findOrFail($id);
        $bookAuthor->delete();

        return response()->json(null, 204);
    }
}
