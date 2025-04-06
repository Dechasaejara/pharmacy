<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(7);
        return view('transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quotation_id' => 'required|exists:quotations,id',
            'profile_id' => 'required|exists:profiles,id',
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'completed_at' => 'nullable|date',
        ]);

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', ['transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'quotation_id' => 'required|exists:quotations,id',
            'profile_id' => 'required|exists:profiles,id',
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'completed_at' => 'nullable|date',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}