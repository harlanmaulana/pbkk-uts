<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Loans;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function index()
    {
        return response()->json(Loans::with(['user', 'book'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users1,user_id',
            'book_id' => 'required|exists:books,book_id',
        ]);

        $loan = Loans::create($validated);

        return response()->json($loan, 201);
    }

    public function show($id)
    {
        $loan = Loans::with(['user', 'book'])->findOrFail($id);
        return response()->json($loan);
    }

    public function update(Request $request, $id)
    {
        $loan = Loans::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users1,user_id',
            'book_id' => 'sometimes|required|exists:books,book_id',
        ]);

        $loan->update($validated);

        return response()->json($loan);
    }

    public function destroy($id)
    {
        $loan = Loans::findOrFail($id);
        $loan->delete();

        return response()->json(null, 204);
    }
}
