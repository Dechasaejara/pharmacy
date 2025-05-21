<x-dashboardLayout :title="$formTitle" :breadcrumb="['Profiles' => route('profiles.index'), $formTitle => null]">
    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">{{ $formTitle }}</h1>

        <form action="{{ route('profiles.processRoleAssignment') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-8 rounded-xl shadow-lg space-y-8 max-w-4xl mx-auto" id="assignRoleForm">
            @csrf

            <input type="hidden" name="role" value="{{ $roleToAssign }}">
            <input type="hidden" name="pharmacy_id" value="{{ $targetPharmacy->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[70vh] overflow-y-auto pr-4">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Select User <span class="text-red-500">*</span></label>
                    <select id="user_id" name="user_id"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('user_id') border-red-500 @enderror"
                        required>
                        <option value="" disabled selected>Select a user</option>
                        @foreach ($eligibleUsers as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->email }} ({{ $user->name ?? 'Name not set' }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Assigning to Pharmacy</label>
                    <p class="text-gray-900 bg-gray-100 p-2 rounded-md">{{ $targetPharmacy->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role to be Assigned</label>
                    <p class="text-gray-900 bg-gray-100 p-2 rounded-md">{{ $roleToAssign }}</p>
                </div>

                <div class="md:col-span-2 my-4 border-t pt-4">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">User Profile Details (Optional during assignment)</h2>
                </div>
                
                @php $profile = null; /* To make the partial work without a full profile object initially */ @endphp
                @include('profiles._profile_form_fields', ['profile' => $profile])

            </div>

            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ Auth::user()->profile->role === 'Admin' ? route('pharmacies.show', $targetPharmacy->id) : route('dashboard') }}"
                    class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-colors shadow-sm">Cancel</a>
                <button type="submit"
                    class="bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ $submitButtonText }}</span>
                </button>
            </div>
        </form>
    </div>

    @include('partials._geolocation_script') {{-- Assuming you have this from edit.blade.php --}}
</x-dashboardLayout>