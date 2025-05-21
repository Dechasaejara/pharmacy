<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function assign(int $pharmacy_id)
    {
        $pharmacy = Pharmacy::findOrFail($pharmacy_id); // Ensure the pharmacy exists
        $pharmacies = Pharmacy::all();
        $users = User::all();
    
        return view('profiles.assign', compact('pharmacy', 'pharmacies', 'users'));
    }

    public function edit(Profile $profile)
    {
        $pharmacies = Pharmacy::all();
        $users = User::all();

        return view('profiles.edit', compact('profile', 'pharmacies','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $currentRole = Auth::user()->profile->role;
        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
            'fullname' => 'string|max:500',
            'picture' => 'nullable|image|max:2048',
            'role' => 'nullable|in:User,Admin,Pharmacist,Manager',
            'user_id' => 'nullable|exists:users,id',
            'pharmacy_id' => 'nullable|exists:pharmacies,id',
            'phone' => 'nullable|regex:/^[0-9]{5,15}$/',
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
        $oldPicture = $profile->picture;

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('profiles', 'public');
        }

        try {
            DB::transaction(function () use ($profile, $validated) {
                $profile->update($validated);
            });

            // Delete old picture after successful update
            if ($request->hasFile('picture') && $oldPicture) {
                Storage::disk('public')->delete($oldPicture);
            }

            if ($profile->role == $currentRole) {
                return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
            }
            return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            // Clean up new picture if update fails
            if ($request->hasFile('picture')) {
                Storage::disk('public')->delete($validated['picture']);
            }
            return back()->withErrors('Failed to update profile: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        try {
            DB::transaction(function () use ($profile) {
                $profile->delete();
            });

            // Delete picture after successful deletion
            if ($profile->picture) {
                Storage::disk('public')->delete($profile->picture);
            }

            return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors('Failed to delete profile: ' . $e->getMessage());
        }
    }
}
