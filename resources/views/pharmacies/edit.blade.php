<!-- filepath: /home/d/coder/pharmacy/resources/views/pharmacies/edit.blade.php -->
<x-dashboardLayout :title="'Edit Pharmacy'" :breadcrumb="['Pharmacies' => route('pharmacies.index'), 'Edit' => null]">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Pharmacy</h1>

        <form action="{{ route('pharmacies.update', $pharmacy->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Pharmacy Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $pharmacy->name) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- License Number -->
            <div class="mb-4">
                <label for="license_number" class="block text-gray-700 font-medium mb-2">License Number</label>
                <input type="text" id="license_number" name="license_number" value="{{ old('license_number', $pharmacy->license_number) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('license_number') border-red-500 @enderror" required>
                @error('license_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
                <textarea id="location" name="location" rows="4"
                          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('location') border-red-500 @enderror">{{ old('location', $pharmacy->location) }}</textarea>
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-2">Phone</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $pharmacy->phone) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('phone') border-red-500 @enderror">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $pharmacy->email) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Picture -->
            <div class="mb-4">
                <label for="picture" class="block text-gray-700 font-medium mb-2">Picture</label>
                <input type="file" id="picture" name="picture"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('picture') border-red-500 @enderror">
                @if ($pharmacy->picture)
                    <img src="{{ asset('storage/' . $pharmacy->picture) }}" alt="Pharmacy Image" class="w-16 h-16 mt-2 rounded">
                @endif
                @error('picture')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Latitude -->
            <div class="mb-4">
                <label for="latitude" class="block text-gray-700 font-medium mb-2">Latitude</label>
                <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $pharmacy->latitude) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('latitude') border-red-500 @enderror">
                @error('latitude')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Longitude -->
            <div class="mb-4">
                <label for="longitude" class="block text-gray-700 font-medium mb-2">Longitude</label>
                <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $pharmacy->longitude) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('longitude') border-red-500 @enderror">
                @error('longitude')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Country -->
            <div class="mb-4">
                <label for="country" class="block text-gray-700 font-medium mb-2">Country</label>
                <input type="text" id="country" name="country" value="{{ old('country', $pharmacy->country) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('country') border-red-500 @enderror">
                @error('country')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- State -->
            <div class="mb-4">
                <label for="state" class="block text-gray-700 font-medium mb-2">State</label>
                <input type="text" id="state" name="state" value="{{ old('state', $pharmacy->state) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('state') border-red-500 @enderror">
                @error('state')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- City -->
            <div class="mb-4">
                <label for="city" class="block text-gray-700 font-medium mb-2">City</label>
                <input type="text" id="city" name="city" value="{{ old('city', $pharmacy->city) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('city') border-red-500 @enderror">
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-500">
                    Update Pharmacy
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>