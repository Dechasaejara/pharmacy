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

<div>
    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
    <input type="tel" id="phone" name="phone"
        value="{{ old('phone', $profile->phone ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('phone') border-red-500 @enderror"
        pattern="[0-9]{5,15}" title="Enter a valid phone number (5-15 digits)">
    @error('phone')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
    <input type="date" id="date_of_birth" name="date_of_birth"
        value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('date_of_birth') border-red-500 @enderror">
    @error('date_of_birth')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

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

<div class="md:col-span-2">
    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
    <textarea id="bio" name="bio" rows="3"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('bio') border-red-500 @enderror">{{ old('bio', $profile->bio ?? '') }}</textarea>
    @error('bio')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>


<div class="md:col-span-2">
    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
    <textarea id="address" name="address" rows="3"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('address') border-red-500 @enderror">{{ old('address', $profile->address ?? '') }}</textarea>
    @error('address')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
    <input type="text" id="latitude" name="latitude"
        value="{{ old('latitude', $profile->latitude ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('latitude') border-red-500 @enderror">
    @error('latitude')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
    <input type="text" id="longitude" name="longitude"
        value="{{ old('longitude', $profile->longitude ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('longitude') border-red-500 @enderror">
    @error('longitude')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
    <input type="text" id="country" name="country"
        value="{{ old('country', $profile->country ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('country') border-red-500 @enderror">
    @error('country')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State</label>
    <input type="text" id="state" name="state"
        value="{{ old('state', $profile->state ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('state') border-red-500 @enderror">
    @error('state')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
    <input type="text" id="city" name="city"
        value="{{ old('city', $profile->city ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('city') border-red-500 @enderror">
    @error('city')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

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

<div class="md:col-span-2">
    <label for="picture" class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
    <input type="file" id="picture" name="picture" accept="image/*"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('picture') border-red-500 @enderror">
    @if (isset($profile) && $profile->picture)
        <div class="mt-3">
            <img src="{{ asset('storage/' . $profile->picture) }}" alt="Current Profile Picture"
                class="w-20 h-20 rounded-full object-cover border-2 border-gray-200" id="picturePreview">
        </div>
    @else
        <div class="mt-3">
            <img src="" alt="Profile Picture Preview"
                class="w-20 h-20 rounded-full object-cover border-2 border-gray-200 hidden" id="picturePreview">
        </div>
    @endif
    @error('picture')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="md:col-span-2">
    <label for="social_links" class="block text-sm font-medium text-gray-700 mb-2">Social Links (comma-separated)</label>
    <textarea id="social_links" name="social_links" rows="3"
        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors @error('social_links') border-red-500 @enderror">{{ old('social_links', $profile->social_links ?? '') }}</textarea>
    @error('social_links')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>