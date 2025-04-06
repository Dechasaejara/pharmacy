<!-- filepath: /home/d/coder/pharmacy/resources/views/profile/create.blade.php -->
<x-dashboardLayout :title="'Create Profile'" :breadcrumb="['Profiles' => route('profiles.index'), 'Create' => null]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Create Profile</h1>

        <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf

            <!-- Grid Layout for Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role <span class="text-red-500">*</span></label>
                    <select id="role" name="role" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('role') border-red-500 @enderror" required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select Role</option>
                        @foreach(['User', 'Admin', 'Pharmacist'] as $roleOption)
                            <option value="{{ $roleOption }}" {{ old('role') === $roleOption ? 'selected' : '' }}>{{ $roleOption }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('phone') border-red-500 @enderror"
                           pattern="[0-9]{10,15}" title="Enter a valid phone number (10-15 digits)">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('date_of_birth') border-red-500 @enderror">
                    @error('date_of_birth')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select id="gender" name="gender" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('gender') border-red-500 @enderror">
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                        @foreach(['Male', 'Female', 'Other'] as $genderOption)
                            <option value="{{ $genderOption }}" {{ old('gender') === $genderOption ? 'selected' : '' }}>{{ $genderOption }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea id="address" name="address" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Picture -->
                <div>
                    <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                    <input type="file" id="picture" name="picture" accept="image/*"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('picture') border-red-500 @enderror">
                    @error('picture')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Social Links -->
                <div class="md:col-span-2">
                    <label for="social_links" class="block text-sm font-medium text-gray-700 mb-1">Social Links (comma-separated)</label>
                    <textarea id="social_links" name="social_links" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('social_links') border-red-500 @enderror">{{ old('social_links') }}</textarea>
                    @error('social_links')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('profiles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Create Profile
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>