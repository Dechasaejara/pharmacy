<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Quotation;
use App\Models\TransactionVw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user()->profile;

        // Query transactions based on user role
        $query = TransactionVw::query();
        // dd($query);
        if ($profile->role === 'User') {
            $query->where('profile_id', $profile->id);
        }

        $transactions = $query->latest()->paginate(7);

        return view('transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $quotations = Quotation::with('profile')->get();
        $quotations = Quotation::get();
        // dd($pharmacies);
        return view('transactions.create', compact('quotations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quotation_id' => 'required|exists:quotations,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'completed_at' => 'nullable|date',
        ], [
            'quotation_id.required' => 'The quotation ID is required.',
            'quotation_id.exists' => 'The selected quotation does not exist.',
            'total_amount.required' => 'The total amount is required.',
            'total_amount.numeric' => 'The total amount must be a valid number.',
            'status.required' => 'The status is required.',
        ]);

        try {
            // Ensure the quotation belongs to the authenticated user's profile
            $quotation = Quotation::findOrFail($validated['quotation_id']);
            if (Auth::user()->profile->id !== $quotation->profile_id) {
                return redirect()->back()->withErrors(['quotation_id' => 'You are not authorized to use this quotation.']);
            }

            $transaction = Transaction::create($validated);
            // dd($transaction);
            return redirect()->route('transactions.index')->with('success', 'Transaction added successfully.');
        } catch (\Exception $e) {
            Log::error('Transaction creation failed: ' . $e->getMessage());
            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the transaction.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        if (!$transaction) {
            abort(404, 'Transaction not found.');
        }

        return view('transactions.edit', ['transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'quotation_id' => 'required|exists:quotations,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'completed_at' => 'nullable|date',
        ], [
            'quotation_id.required' => 'The quotation ID is required.',
            'quotation_id.exists' => 'The selected quotation does not exist.',
            'total_amount.required' => 'The total amount is required.',
            'total_amount.numeric' => 'The total amount must be a valid number.',
            'status.required' => 'The status is required.',
        ]);

        try {
            $transaction->update($validated);

            return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
        } catch (\Exception $e) {
            Log::error('Transaction update failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the transaction.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            $transaction->delete();

            return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Transaction deletion failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while deleting the transaction.']);
        }
    }
}
