<x-layout>
    <div class="container mx-auto max-w-md bg-white p-6 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
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

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" id="remember" name="remember"
                    class="mr-2 border-gray-300 rounded focus:ring focus:ring-green-500">
                <label for="remember" class="text-gray-700">Remember Me</label>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-500">
                    Login
                </button>
            </div>
            @error('failed')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </form>
    </div>
</x-layout>
