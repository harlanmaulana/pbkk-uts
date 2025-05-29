<?php

namespace App\Http\Controllers;

use App\Models\Users1;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Users1Controller extends Controller
{
    /**
     * Tampilkan semua users.
     */
    public function index(): JsonResponse
    {
        $users = Users1::all();
        return response()->json($users, 200);
    }

    /**
     * Tambah user baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users1,email',
            'password' => 'required|string|max:50',
            'membership_date' => 'required|date',
        ]);

        $user = Users1::create($validated);

        return response()->json($user, 201);
    }

    /**
     * Tampilkan user berdasarkan ID.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $user = Users1::findOrFail($id);
            return response()->json($user, 200);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Update data user.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $user = Users1::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:50',
                'email' => 'sometimes|required|email|unique:users1,email,' . $id . ',user_id',
                'password' => 'sometimes|required|string|max:50',
                'membership_date' => 'sometimes|required|date',
            ]);

            $user->update($validated);

            return response()->json($user, 200);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Hapus user berdasarkan ID.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $user = Users1::findOrFail($id);
            $user->delete();

            return response()->json(null, 204);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
