<x-layout>
    <div class="container mx-auto max-w-md bg-white p-6 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
        @if (session('success'))
            {
            <x-messanger msg="{{ session('success') }}" />
            }
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Username</label>
                <input type="text" id="name" name="name"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500
                    @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="text" id="email" name="email"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500
                    @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500
                    @error('password') border-red-500 @enderror"
                    required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500
                    @error('password_confirmation') border-red-500 @enderror"
                    required>
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            {{-- <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium mb-2">Role</label>
                <select id="role" name="role"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500
                    @error('role') border-red-500 @enderror"
                    required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="pharmacist" {{ old('role') == 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-500">
                    Register
                </button>
            </div>
        </form>
    </div>
</x-layout>
