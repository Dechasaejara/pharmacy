<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{


    public function index()
    {
        $userProfile = Auth::user()->profile;

        // Base query with eager loading
        $profilesQuery = Profile::with('user', 'pharmacy')->latest();

        // Apply role-based filters
        if ($userProfile->role === 'Manager' || $userProfile->role === 'Pharmacist') {
            $profilesQuery->where('role', '!=', 'Admin')
                ->where(function ($query) use ($userProfile) {
                    $query->where('pharmacy_id', $userProfile->pharmacy_id)
                        ->orWhereNull('pharmacy_id');
                });
        }

        // Paginate the results
        $profiles = $profilesQuery->paginate(10);

        return view('profiles.index', ['profiles' => $profiles]);
    }

    public function showAssignManagerForm(Pharmacy $pharmacy)
    {

        $eligibleUsers = User::whereDoesntHave('profile', function ($query) {
            $query->whereIn('role', ['Manager', 'Pharmacist']);
        })->orWhereDoesntHave('profile')
            ->where('id', '!=', Auth::id())
            ->orderBy('email')->get();

        return view('profiles.assign_role', [
            'targetPharmacy' => $pharmacy,
            'eligibleUsers' => $eligibleUsers,
            'roleToAssign' => 'Manager',
            'formTitle' => 'Assign Manager to ' . $pharmacy->name,
            'submitButtonText' => 'Assign Manager'
        ]);
    }

    /**
     * Show the form for a Manager to assign Pharmacists to their pharmacy.
     * Accessed by Manager (or Admin).
     */
    public function showAssignPharmacistForm()
    {
        // $this->authorize('assignPharmacist', Profile::class); // Example policy

        $managerProfile = Auth::user()->profile;
        if (!$managerProfile || $managerProfile->role !== 'Manager' || !$managerProfile->pharmacy_id) {
            // Admin might also access this, or it's strictly for managers.
            // If Admin, they might need to select a pharmacy first, or this route is manager-specific.
            if ($managerProfile->role === 'Admin' && request()->has('pharmacy_id')) {
                $pharmacy = Pharmacy::findOrFail(request('pharmacy_id'));
            } elseif ($managerProfile->role === 'Manager' && $managerProfile->pharmacy_id) {
                $pharmacy = $managerProfile->pharmacy;
            } else {
                return redirect()->route('dashboard')->with('error', 'You are not authorized or not associated with a pharmacy.');
            }
        }


        $eligibleUsers = User::whereDoesntHave('profile', function ($query) {
            $query->whereIn('role', ['Manager', 'Pharmacist']);
        })->orWhereDoesntHave('profile')
            ->where('id', '!=', Auth::id()) // Manager cannot assign themselves as pharmacist typically
            ->orderBy('email')->get();

        return view('profiles.assign_role', [
            'targetPharmacy' => $pharmacy,
            'eligibleUsers' => $eligibleUsers,
            'roleToAssign' => 'Pharmacist',
            'formTitle' => 'Assign Pharmacist to ' . $pharmacy->name,
            'submitButtonText' => 'Assign Pharmacist'
        ]);
    }

    /**
     * Store the newly assigned role and basic profile information.
     */
    public function processRoleAssignment(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => ['required', Rule::in(['Manager', 'Pharmacist'])],
            'pharmacy_id' => 'required|exists:pharmacies,id',
            // Include basic profile fields from the shared form
            'fullname' => 'required|string|max:255',
            'phone' => 'nullable|regex:/^[0-9]{5,15}$/',
            'picture' => 'nullable|image|max:2048', // Max 2MB
            'bio' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => ['nullable', Rule::in(['Male', 'Female', 'Other'])],
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'social_links' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($validated['user_id']);

        // Authorize based on role being assigned
        // if ($validated['role'] === 'Manager') {
        //     $this->authorize('assignManager', Profile::class);
        // } elseif ($validated['role'] === 'Pharmacist') {
        //     $this->authorize('assignPharmacist', [Profile::class, $validated['pharmacy_id']]);
        // }

        $profileData = $validated;
        unset($profileData['user_id']); // user_id is for relation, not profile table directly in updateOrCreate first arg

        if ($request->hasFile('picture')) {
            // If there's an old picture for this user's profile, delete it
            if ($user->profile && $user->profile->picture) {
                Storage::disk('public')->delete($user->profile->picture);
            }
            $profileData['picture'] = $request->file('picture')->store('profiles', 'public');
        }


        DB::transaction(function () use ($user, $profileData) {
            $profile = Profile::updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );
        });

        $successMessage = $validated['role'] . ' assigned successfully to ' . $user->email . '.';
        if ($validated['role'] === 'Manager') {
            return redirect()->route('pharmacies.index')->with('success', $successMessage);
        }
        return redirect()->route('profiles.index')->with('success', $successMessage); // Or manager's dashboard/staff list
    }


    public function edit(Profile $profile)
    {
        // $this->authorize('update', $profile); // Policy check

        $pharmacies = (Auth::user()->profile->role === 'Admin') ? Pharmacy::all() : Pharmacy::where('id', Auth::user()->profile->pharmacy_id)->get();
        // Users list not typically needed when editing a specific profile, as user is fixed.
        // If Admin needs to change the user_id of a profile (unusual), then pass users.
        $users = (Auth::user()->profile->role === 'Admin') ? User::orderBy('email')->get() : collect([]);


        return view('profiles.edit', compact('profile', 'pharmacies', 'users'));
    }

    public function update(Request $request, Profile $profile)
    {
        // $this->authorize('update', $profile);

        $currentAuthUserRole = Auth::user()->profile->role;

        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
            'fullname' => 'required|string|max:500',
            'picture' => 'nullable|image|max:2048',
            'role' => ['nullable', Rule::in(['User', 'Admin', 'Pharmacist', 'Manager'])],
            // user_id is generally not changed during a profile update. If it is, ensure policy allows.
            // 'user_id' => 'nullable|exists:users,id|unique:profiles,user_id,' . $profile->id,
            'pharmacy_id' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array($request->input('role'), ['Manager', 'Pharmacist']);
                }),
                'nullable',
                'exists:pharmacies,id'
            ],
            'phone' => 'nullable|regex:/^[0-9]{5,15}$/',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => ['nullable', Rule::in(['Male', 'Female', 'Other'])],
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'social_links' => 'nullable|string|max:255',
        ]);

        // Prevent non-admins from escalating roles or changing critical fields without permission
        // if ($currentAuthUserRole !== 'Admin') {
        //     unset($validated['role']); // Non-admins cannot change roles directly via general edit
        //     // Potentially unset pharmacy_id too if manager shouldn't reassign widely
        //      if ($currentAuthUserRole === 'Manager' && isset($validated['pharmacy_id']) && $validated['pharmacy_id'] != $profile->pharmacy_id) {
        //          // Manager might only be allowed to assign within their pharmacy or not at all via this form
        //          // This depends on stricter business rules. For now, if dropdown is shown, they can change.
        //      }
        // }


        $oldPicture = $profile->picture;

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('profiles', 'public');
        }

        try {
            DB::transaction(function () use ($profile, $validated) {
                $profile->update($validated);
            });

            if ($request->hasFile('picture') && $oldPicture) {
                Storage::disk('public')->delete($oldPicture);
            }

            // If the updated profile is the authenticated user's own profile
            if ($profile->id === Auth::user()->profile->id) {
                return redirect()->route('dashboard')->with('success', 'Your profile updated successfully.');
            }
            return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            if ($request->hasFile('picture') && isset($validated['picture'])) {
                Storage::disk('public')->delete($validated['picture']);
            }
            return back()->withErrors('Failed to update profile: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Profile $profile)
    {
        // $this->authoriz('delete', $profile);

        try {
            DB::transaction(function () use ($profile) {
                // What happens to the user record? Only delete profile or user too?
                // If user is deleted, their associations (prescriptions, etc.) need handling.
                // For now, just deleting the profile.
                if ($profile->picture) {
                    Storage::disk('public')->delete($profile->picture);
                }
                $profile->delete();
            });
            return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors('Failed to delete profile: ' . $e->getMessage());
        }
    }
}
