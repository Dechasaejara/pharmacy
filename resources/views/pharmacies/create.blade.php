<!-- filepath: /home/d/coder/pharmacy/resources/views/pharmacies/create.blade.php -->
<x-dashboardLayout :title="'Add Pharmacy'" :breadcrumb="['Pharmacies' => route('pharmacies.index'), 'Create' => null]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Pharmacy</h1>

        <form action="{{ route('pharmacies.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf

            <!-- Grid Layout for Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Pharmacy Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- License Number -->
                <div>
                    <label for="license_number" class="block text-sm font-medium text-gray-700 mb-1">License Number <span class="text-red-500">*</span></label>
                    <input type="text" id="license_number" name="license_number" value="{{ old('license_number') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('license_number') border-red-500 @enderror" required>
                    @error('license_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <textarea id="location" name="location" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('location') border-red-500 @enderror">{{ old('location') }}</textarea>
                    @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Picture -->
                <div>
                    <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Picture</label>
                    <input type="file" id="picture" name="picture" accept="image/*"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('picture') border-red-500 @enderror">
                    @error('picture')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Latitude -->
                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('latitude') border-red-500 @enderror">
                    @error('latitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Longitude -->
                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('longitude') border-red-500 @enderror">
                    @error('longitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Country -->
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                    <input type="text" id="country" name="country" value="{{ old('country') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('country') border-red-500 @enderror">
                    @error('country')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- State -->
                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                    <input type="text" id="state" name="state" value="{{ old('state') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('state') border-red-500 @enderror">
                    @error('state')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('city') border-red-500 @enderror">
                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('pharmacies.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Add Pharmacy
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>