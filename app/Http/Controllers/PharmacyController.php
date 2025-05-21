<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pharmacies = Pharmacy::with('pharmacists')->latest()->paginate(7);
        return view('pharmacies.index', ['pharmacies' => $pharmacies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255|unique:pharmacies,license_number',
            'address' => 'nullable|string|max:500',
            'picture' => 'nullable|image|max:2048', // Max 2MB
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:pharmacies,email',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('pharmacies', 'public');
        }

         $creatorProfileId = Auth::user()->profile->id ?? null;
        if (!$creatorProfileId) {
            // Handle cases where the user might not have a profile, though 'auth' middleware should ensure a user.
            // This depends on your application's user setup.
            // For now, we assume a profile exists for the authenticated user.
        }


        $pharmacy = Pharmacy::create(['profile_id' => $creatorProfileId, ...$validated]);

        return redirect()->route('profiles.showAssignManagerForm', ['pharmacy' => $pharmacy->id])
            ->with('success', 'Pharmacy created successfully. Please assign a Manager.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pharmacy $pharmacy)
    {
        return view('pharmacies.edit', ['pharmacy' => $pharmacy]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255|unique:pharmacies,license_number,' . $pharmacy->id,
            'address' => 'nullable|string|max:500',
            'picture' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:pharmacies,email,' . $pharmacy->id,
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('picture')) {
            if ($pharmacy->picture) {
                Storage::disk('public')->delete($pharmacy->picture);
            }
            $validated['picture'] = $request->file('picture')->store('pharmacies', 'public');
        }

        $pharmacy->update($validated);

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        if ($pharmacy->picture) {
            Storage::disk('public')->delete($pharmacy->picture);
        }
        $pharmacy->delete();

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy deleted successfully.');
    }
}