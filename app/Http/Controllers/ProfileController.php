<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::latest()->paginate(10);
        return view('profiles.index', ['profiles' => $profiles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
            'picture' => 'nullable|image|max:2048',
            'role' => 'required|in:User,Admin,Pharmacist',
            'phone' => 'nullable|regex:/^[0-9]{10,15}$/',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'social_links' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('profiles', 'public');
        }

        Profile::create($validated);

        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return view('profiles.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('profiles.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
            'picture' => 'nullable|image|max:2048',
            'role' => 'required|in:User,Admin,Pharmacist',
            'phone' => 'nullable|regex:/^[0-9]{10,15}$/',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'social_links' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('picture')) {
            // Delete the old picture if it exists
            if ($profile->picture) {
                Storage::disk('public')->delete($profile->picture);
            }
            $validated['picture'] = $request->file('picture')->store('profiles', 'public');
        }

        $profile->update($validated);

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        // Delete the picture if it exists
        if ($profile->picture) {
            Storage::disk('public')->delete($profile->picture);
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}