<x-dashboardLayout :title="isset($profile) ? 'Edit Profile' : 'Create Profile'" :breadcrumb="['Profiles' => route('profiles.index'), isset($profile) ? 'Edit' : 'Create' => null]">
    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">{{ isset($profile) ? 'Edit Profile' : 'Create Profile' }}</h1>
        <form action="{{ isset($profile) ? route('profiles.update', $profile) : route('profiles.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-8 rounded-xl shadow-lg space-y-8 max-w-4xl mx-auto" id="profileForm">
            @csrf
            @if (isset($profile))
                @method('PUT')
            @endif

            <!-- Grid Layout for Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[70vh] overflow-y-auto pr-4">
                <!-- User Field (only for creating) -->
                @if (!isset($profile))
                    <div>
                        <label for="user" class="block text-sm font-medium text-gray-700 mb-2">User <span class="text-red-500">*</span></label>
                        <select id="user" name="user_id"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('user_id') border-red-500 @enderror"
                            required>
                            <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->email }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <!-- Full Name -->
                <div>
                    <label for="fullname" class="block text-sm font-medium text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" id="fullname" name="fullname"
                        value="{{ old('fullname', $profile->fullname ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('fullname') border-red-500 @enderror"
                        required>
                    @error('fullname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role (only if creating or if editing and admin) -->
                @if (!isset($profile) || (isset($profile) && auth()->user()->profile->role === 'Admin'))
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role <span class="text-red-500">*</span></label>
                        <select id="role" name="role"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('role') border-red-500 @enderror"
                            required>
                            <option value="" disabled>Select Role</option>
                            @foreach (['User', 'Admin', 'Pharmacist', 'Manager'] as $roleOption)
                                <option value="{{ $roleOption }}" {{ old('role', $profile->role ?? '') === $roleOption ? 'selected' : '' }}>{{ $roleOption }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <!-- Pharmacy (only if creating or if editing and admin) -->
                @if (!isset($profile) || (isset($profile) && auth()->user()->profile->role === 'Admin'))
                    @if (isset($selectedPharmacy))
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pharmacy</label>
                            <p class="text-gray-900">{{ $selectedPharmacy->name }}</p>
                            <input type="hidden" name="pharmacy_id" value="{{ $selectedPharmacy->id }}">
                        </div>
                    @else
                        <div>
                            <label for="pharmacy" class="block text-sm font-medium text-gray-700 mb-2">Pharmacy <span class="text-red-500">*</span></label>
                            <select id="pharmacy" name="pharmacy_id"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('pharmacy_id') border-red-500 @enderror">
                                <option value="" disabled>Select Pharmacy</option>
                                @foreach ($pharmacies as $pharmacy)
                                    <option value="{{ $pharmacy->id }}" {{ old('pharmacy_id', $profile->pharmacy_id ?? '') == $pharmacy->id ? 'selected' : '' }}>{{ $pharmacy->name }}</option>
                                @endforeach
                            </select>
                            @error('pharmacy_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                @endif

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel" id="phone" name="phone"
                        value="{{ old('phone', $profile->phone ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('phone') border-red-500 @enderror"
                        pattern="[0-9]{10,15}" title="Enter a valid phone number (10-15 digits)">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth"
                        value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('date_of_birth') border-red-500 @enderror">
                    @error('date_of_birth')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                    <select id="gender" name="gender"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('gender') border-red-500 @enderror">
                        <option value="" {{ old('gender', $profile->gender ?? '') === null ? 'selected' : '' }}>Select Gender</option>
                        @foreach (['Male', 'Female', 'Other'] as $genderOption)
                            <option value="{{ $genderOption }}" {{ old('gender', $profile->gender ?? '') === $genderOption ? 'selected' : '' }}>{{ $genderOption }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea id="address" name="address" rows="3"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('address') border-red-500 @enderror">{{ old('address', $profile->address ?? '') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Latitude -->
                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                    <input type="text" id="latitude" name="latitude"
                        value="{{ old('latitude', $profile->latitude ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('latitude') border-red-500 @enderror">
                    @error('latitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Longitude -->
                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                    <input type="text" id="longitude" name="longitude"
                        value="{{ old('longitude', $profile->longitude ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('longitude') border-red-500 @enderror">
                    @error('longitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Country -->
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <input type="text" id="country" name="country"
                        value="{{ old('country', $profile->country ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('country') border-red-500 @enderror">
                    @error('country')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- State -->
                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State</label>
                    <input type="text" id="state" name="state"
                        value="{{ old('state', $profile->state ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('state') border-red-500 @enderror">
                    @error('state')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <input type="text" id="city" name="city"
                        value="{{ old('city', $profile->city ?? '') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('city') border-red-500 @enderror">
                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Auto-Fill Button -->
                <div class="md:col-span-2">
                    <button type="button" id="autoFillBtn"
                        class="bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Auto-Fill Location</span>
                    </button>
                </div>

                <!-- Picture -->
                <div>
                    <label for="picture" class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                    <input type="file" id="picture" name="picture" accept="image/*"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('picture') border-red-500 @enderror">
                    @if (isset($profile) && $profile->picture)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $profile->picture) }}" alt="Current Profile Picture"
                                class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                        </div>
                    @endif
                    @error('picture')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Social Links -->
                <div class="md:col-span-2">
                    <label for="social_links" class="block text-sm font-medium text-gray-700 mb-2">Social Links (comma-separated)</label>
                    <textarea id="social_links" name="social_links" rows="3"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('social_links') border-red-500 @enderror">{{ old('social_links', $profile->social_links ?? '') }}</textarea>
                    @error('social_links')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('profiles.index') }}"
                    class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-colors shadow-sm">Cancel</a>
                <button type="submit"
                    class="bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ isset($profile) ? 'Update Profile' : 'Create Profile' }}</span>
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript for Geolocation and Image Preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to form fields
            const latitudeField = document.getElementById('latitude');
            const longitudeField = document.getElementById('longitude');
            const countryField = document.getElementById('country');
            const stateField = document.getElementById('state');
            const cityField = document.getElementById('city');
            const addressField = document.getElementById('address');
            const autoFillBtn = document.getElementById('autoFillBtn');

            // Function to handle geolocation and field population
            function fillGeolocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            // Populate latitude and longitude
                            latitudeField.value = position.coords.latitude;
                            longitudeField.value = position.coords.longitude;

                            // Reverse geocoding using Nominatim API
                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`)
                                .then(response => response.json())
                                .then(data => {
                                    const address = data.address || {};
                                    countryField.value = address.country || '';
                                    stateField.value = address.state || address.region || '';
                                    cityField.value = address.city || address.town || address.village || '';
                                    addressField.value = data.display_name || '';
                                })
                                .catch(error => {
                                    console.error('Error fetching location details:', error);
                                    alert('Unable to fetch location details. Please try again.');
                                });
                        },
                        function(error) {
                            console.error('Geolocation error:', error.message);
                            alert('Unable to retrieve location. Please check permissions or try again.');
                        }, {
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

            // Trigger auto-fill on page load if all fields are empty
            if (!latitudeField.value && !longitudeField.value && !countryField.value && !stateField.value && !cityField.value && !addressField.value) {
                fillGeolocation();
            }

            // Attach the function to the button click event
            autoFillBtn.addEventListener('click', fillGeolocation);

            // Image Preview
            const pictureInput = document.getElementById('picture');
            pictureInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-20', 'h-20', 'rounded-full', 'object-cover', 'mt-3', 'border-2', 'border-gray-200');
                        const container = pictureInput.nextElementSibling;
                        if (container && container.tagName === 'DIV') {
                            container.innerHTML = '';
                            container.appendChild(img);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</x-dashboardLayout>