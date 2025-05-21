<x-dashboardLayout :title="'Edit Pharmacy'" :breadcrumb="['Pharmacies' => route('pharmacies.index'), 'Edit' => null]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Pharmacy</h1>

        <form action="{{ route('pharmacies.update', $pharmacy->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Pharmacy Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $pharmacy->name) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="license_number" class="block text-sm font-medium text-gray-700 mb-1">License Number <span class="text-red-500">*</span></label>
                    <input type="text" id="license_number" name="license_number" value="{{ old('license_number', $pharmacy->license_number) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('license_number') border-red-500 @enderror" required>
                    @error('license_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea id="address" name="address" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('address') border-red-500 @enderror">{{ old('address', $pharmacy->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $pharmacy->phone) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $pharmacy->email) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Picture</label>
                    <input type="file" id="picture" name="picture" accept="image/*"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('picture') border-red-500 @enderror">
                    @if ($pharmacy->picture)
                        <div class="mt-2">
                            <span class="block text-xs text-gray-500 mb-1">Current Picture:</span>
                            <img src="{{ asset('storage/' . $pharmacy->picture) }}" alt="Pharmacy Image" class="w-20 h-20 rounded-md object-cover">
                        </div>
                    @endif
                    @error('picture')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $pharmacy->latitude) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('latitude') border-red-500 @enderror">
                    @error('latitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $pharmacy->longitude) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('longitude') border-red-500 @enderror">
                    @error('longitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                    <input type="text" id="country" name="country" value="{{ old('country', $pharmacy->country) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('country') border-red-500 @enderror">
                    @error('country')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                    <input type="text" id="state" name="state" value="{{ old('state', $pharmacy->state) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('state') border-red-500 @enderror">
                    @error('state')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input type="text" id="city" name="city" value="{{ old('city', $pharmacy->city) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('city') border-red-500 @enderror">
                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <button type="button" id="autoFillBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Auto-Fill Location
                    </button>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('pharmacies.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Update Pharmacy
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const latitudeField = document.getElementById('latitude');
            const longitudeField = document.getElementById('longitude');
            const countryField = document.getElementById('country');
            const stateField = document.getElementById('state');
            const cityField = document.getElementById('city');
            const addressField = document.getElementById('address');
            const autoFillBtn = document.getElementById('autoFillBtn');

            function fillGeolocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            latitudeField.value = position.coords.latitude;
                            longitudeField.value = position.coords.longitude;
                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`)
                                .then(response => response.json())
                                .then(data => {
                                    const address = data.address || {};
                                    countryField.value = address.country || '';
                                    stateField.value = address.state || address.region || '';
                                    cityField.value = address.city || address.town || address.village || '';
                                    // Only update addressField if it's currently empty or if the user explicitly clicks auto-fill
                                    // This prevents overwriting an existing address unless intended.
                                    if (!addressField.value.trim() || event.target === autoFillBtn) {
                                        addressField.value = data.display_name || '';
                                    }
                                })
                                .catch(error => {
                                    console.error('Error fetching location details:', error);
                                    alert('Unable to fetch location details. Please try again.');
                                });
                        },
                        function (error) {
                            console.error('Geolocation error:', error.message);
                            alert('Unable to retrieve location. Please check permissions or try again.');
                        },
                        {
                            enableHighAccuracy: true,
                            timeout: 10000,
                            maximumAge: 0
                        }
                    );
                } else {
                    console.warn('Geolocation is not supported by this browser.');
                    alert('Geolocation is not supported by your browser.');
                }
            }

            // Auto-fill on load only if ALL relevant location fields are empty
            // This is less aggressive than the create form to avoid overwriting existing data.
            // if (!latitudeField.value && !longitudeField.value && !countryField.value && !stateField.value && !cityField.value && !addressField.value.trim()) {
            //     // fillGeolocation(); // Decided against auto-fill on load for edit to preserve existing data. User can click the button.
            // }

            // Attach to button click
            autoFillBtn.addEventListener('click', fillGeolocation);
        });
    </script>
</x-dashboardLayout>