<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorsController extends Controller
{
    public function index()
    {
        return response()->json(Authors::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nationality' => 'required|string',
            'birthdate' => 'required|string',
        ]);

        $author = Authors::create($validated);

        return response()->json($author, 201);
    }

    public function show($id)
    {
        $author = Authors::findOrFail($id);
        return response()->json($author);
    }

    public function update(Request $request, $id)
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

    public function destroy($id)
    {
        $author = Authors::findOrFail($id);
        $author->delete();

        return response()->json(null, 204);
    }
}
