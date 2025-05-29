<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoansController extends Controller
{
    /**
     * Display a listing of all loans with related user and book.
     */
    public function index(): JsonResponse
    {
        $loans = Loans::with(['user', 'book'])->get();
        return response()->json($loans);
    }

    /**
     * Store a newly created loan.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users1,user_id',
            'book_id' => 'required|exists:books,book_id',
        ]);

        $loan = Loans::create($validated);

        return response()->json($loan, 201);
    }

    /**
     * Display the specified loan by ID with user and book relation.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $loan = Loans::with(['user', 'book'])->findOrFail($id);
            return response()->json($loan);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
    }

    /**
     * Update the specified loan.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $loan = Loans::findOrFail($id);

            $validated = $request->validate([
                'user_id' => 'sometimes|required|exists:users1,user_id',
                'book_id' => 'sometimes|required|exists:books,book_id',
            ]);

            $loan->update($validated);

            return response()->json($loan);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
    }

    /**
     * Remove the specified loan from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $loan = Loans::findOrFail($id);
            $loan->delete();

            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
    }
}
