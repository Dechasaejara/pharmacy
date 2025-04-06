<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prescriptions = Prescription::latest()->paginate(7);
        return view('prescriptions.index', ['prescriptions' => $prescriptions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prescriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'image|max:2048',
            'status' => 'required|string|max:255',
            'medical_notes' => 'nullable|string',
            'issued_date' => 'nullable|date',
        ]);

        if ($request->hasFile('images')) {
            $validated['images'] = array_map(function ($image) {
                return $image->store('prescriptions', 'public');
            }, $request->file('images'));
        }
        $profile =    Prescription::create(['profile_id' => Auth::id(), ...$validated]);
        // dd($profile);
        return redirect()->route('prescriptions.index')->with('success', 'Prescription added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        return view('prescriptions.edit', ['prescription' => $prescription]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'image' => 'image|max:2048',
            'status' => 'required|string|max:255',
            'medical_notes' => 'nullable|string',
            'issued_date' => 'nullable|date',
        ]);

        if ($request->hasFile('images')) {
            $validated['images'] = array_map(function ($image) {
                return $image->store('prescriptions', 'public');
            }, $request->file('images'));
        }

        $prescription->update($validated);

        return redirect()->route('prescriptions.index')->with('success', 'Prescription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully.');
    }
}
