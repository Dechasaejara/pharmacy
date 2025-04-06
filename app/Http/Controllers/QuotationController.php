<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotations = Quotation::latest()->paginate(7);
        return view('quotations.index', ['quotations' => $quotations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quotations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prescription_id' => 'required|exists:prescriptions,id',
            'profile_id' => 'required|exists:profiles,id',
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        Quotation::create($validated);

        return redirect()->route('quotations.index')->with('success', 'Quotation added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        return view('quotations.edit', ['quotation' => $quotation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'prescription_id' => 'required|exists:prescriptions,id',
            'profile_id' => 'required|exists:profiles,id',
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $quotation->update($validated);

        return redirect()->route('quotations.index')->with('success', 'Quotation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully.');
    }
}