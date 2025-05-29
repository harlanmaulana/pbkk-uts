<?php

namespace App\Http\Controllers;

use App\Models\Users1;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Users1Controller extends Controller
{
    public function index()
    {
        return response()->json(Users1::all());
    }

    public function store(Request $request)
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

    public function show($id)
    {
        $user = Users1::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = Users1::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|email|unique:users1,email,' . $id . ',user_id',
            'password' => 'sometimes|required|string|max:50',
            'membership_date' => 'sometimes|required|date',
        ]);

        $user->update($validated);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = Users1::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
