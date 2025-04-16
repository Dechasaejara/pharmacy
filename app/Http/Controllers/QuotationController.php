<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Prescription;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pharmacies = Pharmacy::orderBy('name')->get();

        $profile = Auth::user()->profile;
        $query = Quotation::with('pharmacy');

        if ($profile->role === 'User') {
            $query->where('profile_id', $profile->id);
        }

        $quotations = $query->latest()->paginate(7);
        // dd($quotations);
        return view('quotations.index', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prescriptions = Prescription::with('profile')->get();
        $pharmacies = Pharmacy::get();
        // dd($pharmacies);
        return view('quotations.create', compact('prescriptions', 'pharmacies'));
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
        // dd($validated);
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
