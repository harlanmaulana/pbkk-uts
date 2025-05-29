<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Tampilkan semua user.
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Tampilkan user berdasarkan ID.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user, 200);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Tambah user baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'message' => 'Akun pengguna berhasil ditambahkan.',
            'data' => $user,
        ], 201);
    }

    /**
     * Update data user.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $id,
                'username' => 'sometimes|string|max:255|unique:users,username,' . $id,
                'password' => 'sometimes|string|min:8',
            ]);

            if (isset($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            }

            $user->update($validated);

            return response()->json([
                'message' => $user->wasChanged()
                    ? 'Akun pengguna berhasil diupdate.'
                    : 'Tidak ada perubahan pada data pengguna.',
                'data' => $user,
            ], 200);

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
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User berhasil dihapus.'], 200);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }
    }
}
