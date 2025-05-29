<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index(): JsonResponse
    {
        return response()->json(Authors::all());
    }

    /**
     * Store a newly created author in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nationality' => 'required|string',
            'birthdate' => 'required|string',
        ]);

        $author = Authors::create($validated);

        return response()->json($author, 201);
    }

    /**
     * Display the specified author.
     */
    public function show($id): JsonResponse
    {
        $author = Authors::findOrFail($id);
        return response()->json($author);
    }

    /**
     * Update the specified author in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $author = Authors::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'nationality' => 'sometimes|required|string',
            'birthdate' => 'sometimes|required|string',
        ]);

        $author->update($validated);

        return response()->json($author);
    }

    /**
     * Remove the specified author from storage.
     */
    public function destroy($id): JsonResponse
    {
        $author = Authors::findOrFail($id);
        $author->delete();

        return response()->json(null, 204);
    }
}
