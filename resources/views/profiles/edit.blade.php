<x-dashboardLayout :title="'Edit Profile: ' . $profile->fullname" :breadcrumb="['Profiles' => route('profiles.index'), 'Edit' => null]">
    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Edit Profile: <span class="text-emerald-600">{{ $profile->fullname ?? $profile->user->email }}</span></h1>
        <form action="{{ route('profiles.update', $profile) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-8 rounded-xl shadow-lg space-y-8 max-w-4xl mx-auto" id="profileForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[70vh] overflow-y-auto pr-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">User Email</label>
                    <p class="text-gray-900 bg-gray-100 p-2 rounded-md">{{ $profile->user->email }}</p>
                </div>

                @if (Auth::user()->profile->role === 'Admin')
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role <span class="text-red-500">*</span></label>
                        <select id="role" name="role"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('role') border-red-500 @enderror"
                            required>
                            <option value="" disabled>Select Role</option>
                            @foreach (['User', 'Admin', 'Manager'] as $roleOption)
                                <option value="{{ $roleOption }}" {{ old('role', $profile->role ?? '') === $roleOption ? 'selected' : '' }}>{{ $roleOption }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                @elseif (Auth::user()->profile->role === 'Manager' )
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role <span class="text-red-500">*</span></label>
                        <select id="role" name="role"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('role') border-red-500 @enderror"
                            required>
                            <option value="" disabled>Select Role</option>
                            @foreach (['User', 'Pharmacist'] as $roleOption)
                                <option value="{{ $roleOption }}" {{ old('role', $profile->role ?? '') === $roleOption ? 'selected' : '' }}>{{ $roleOption }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                     <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <p class="text-gray-900 bg-gray-100 p-2 rounded-md">{{ $profile->role }}</p>
                        {{-- Hidden input if role cannot be changed by non-admin but needs to be submitted --}}
                         <input type="hidden" name="role" value="{{ $profile->role }}">
                    </div>
                @endif

                {{-- Adjusted condition for pharmacy_id dropdown --}}
                @if (Auth::user()->profile->role === 'Admin' || (Auth::user()->profile->role === 'Manager' && (old('role', $profile->role ?? '') === 'Pharmacist' || old('role') === 'Pharmacist' )))
                    <div>
                        <label for="pharmacy_id" class="block text-sm font-medium text-gray-700 mb-2">Pharmacy <span class="text-red-500">* (if Manager/Pharmacist)</span></label>
                        <select id="pharmacy_id" name="pharmacy_id"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('pharmacy_id') border-red-500 @enderror"
                            {{ Auth::user()->profile->role === 'Manager' && Auth::user()->profile->pharmacy_id && !old('role') && $profile->role !== 'Pharmacist' ? 'disabled' : '' }}
                            >
                            <option value="">Select Pharmacy</option>
                            @foreach ($pharmacies as $pharmacy)
                                <option value="{{ $pharmacy->id }}" {{ old('pharmacy_id', $profile->pharmacy_id ?? '') == $pharmacy->id ? 'selected' : '' }}>{{ $pharmacy->name }}</option>
                            @endforeach
                        </select>
                        {{-- If the manager is editing a user that isn't a pharmacist, ensure the pharmacy_id is still submitted if it existed before --}}
                        @if (Auth::user()->profile->role === 'Manager' && Auth::user()->profile->pharmacy_id && !old('role') && $profile->role !== 'Pharmacist')
                            @if($profile->pharmacy_id)
                                <input type="hidden" name="pharmacy_id" value="{{ $profile->pharmacy_id }}">
                            @endif
                        @endif
                        @error('pharmacy_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @elseif (Auth::user()->profile->role === 'Manager')
                    {{-- If a Manager is editing a user who is NOT a Pharmacist, and they are not changing the role to Pharmacist --}}
                    @if($profile->pharmacy_id)
                        <input type="hidden" name="pharmacy_id" value="{{ $profile->pharmacy_id }}">
                    @endif
                @endif


                @include('profiles._profile_form_fields', ['profile' => $profile])
            </div>

            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('profiles.index') }}"
                    class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-colors shadow-sm">Cancel</a>
                <button type="submit"
                    class="bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Update Profile</span>
                </button>
            </div>
        </form>
    </div>

   @include('partials._geolocation_script')
</x-dashboardLayout>