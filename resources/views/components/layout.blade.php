<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Pharmacy') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-gray-50 font-sans">
    <!-- Navbar -->
    <header class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-md sticky top-0 z-10">
        <div class="container mx-auto flex flex-wrap justify-between items-center py-4 px-6">
            <!-- Brand -->
            <div class="flex-shrink-0 flex items-center space-x-2">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <a href="/" class="text-2xl font-semibold hover:text-emerald-200 transition-colors">
                    {{ env('APP_NAME', 'Pharmacy') }}
                </a>
            </div>

            <!-- Navigation -->
            <nav class="w-full md:w-auto mt-4 md:mt-0">
                <ul class="flex flex-col md:flex-row md:space-x-8 items-center">
                    <li><a href="#services" class="text-lg hover:text-emerald-200 transition-colors">Services</a></li>
                    <li><a href="#top-pharmacies" class="text-lg hover:text-emerald-200 transition-colors">Top Pharmacies</a></li>
                    <li><a href="#trending-products" class="text-lg hover:text-emerald-200 transition-colors">Trending Products</a></li>
                </ul>
            </nav>
            <div class="flex gap-3 items-center">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center space-x-2 focus:outline-none">
                            @if (false)
                                <img src="" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-emerald-300">
                            @else
                                <img src="/default.jpg" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-emerald-300">
                            @endif
                            <span class="font-medium hidden md:inline">{{ auth()->user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-emerald-100 hover:text-emerald-800 transition-colors">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-emerald-100 hover:text-emerald-800 transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
                @guest
                    <div class="flex gap-3">
                        <a href="{{ route('login') }}"
                            class="bg-emerald-800 text-white py-2 px-4 rounded-lg hover:bg-emerald-900 transition-colors shadow-sm">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-emerald-500 text-white py-2 px-4 rounded-lg hover:bg-emerald-600 transition-colors shadow-sm">Register</a>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-grow w-full p-6 bg-gray-50 overflow-y-auto">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-6">
        <div class="container mx-auto text-center">
            <p class="text-sm">© {{ date('Y') }} {{ env('APP_NAME', 'Pharmacy') }}. All rights reserved.</p>
            <p class="text-sm mt-2">Powered by Laravel</p>
        </div>
    </footer>
</body>

</html>