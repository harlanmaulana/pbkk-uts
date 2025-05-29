<?php

namespace App\Http\Controllers;
use App\Models\BookAuthors;
use Illuminate\Http\Request;

class BookAuthorsController extends Controller
{
    public function index()
    {
        return response()->json(BookAuthors::with(['book', 'author'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,book_id',
            'author_id' => 'required|exists:authors,author_id',
        ]);

        $bookAuthor = BookAuthors::create($validated);

        return response()->json($bookAuthor, 201);
    }

    public function show($id)
    {
        $bookAuthor = BookAuthors::with(['book', 'author'])->findOrFail($id);
        return response()->json($bookAuthor);
    }

    public function update(Request $request, $id)
    {
        $bookAuthor = BookAuthors::findOrFail($id);

        $validated = $request->validate([
            'book_id' => 'sometimes|required|exists:books,book_id',
            'author_id' => 'sometimes|required|exists:authors,author_id',
        ]);

        $bookAuthor->update($validated);

        return response()->json($bookAuthor);
    }

    public function destroy($id)
    {
        $bookAuthor = BookAuthors::findOrFail($id);
        $bookAuthor->delete();

        return response()->json(null, 204);
    }
}
