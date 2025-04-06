<!-- filepath: /home/d/coder/pharmacy/resources/views/components/layout.blade.php -->
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

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navbar -->
    <header class="bg-green-700 text-white shadow-lg">
        <div class="container mx-auto flex flex-wrap justify-between items-center py-4 px-6">
            <!-- Brand -->
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold hover:underline">{{ env('APP_NAME', 'Pharmacy') }}</a>
            </div>

            <!-- Navigation -->
            <nav class="w-full md:w-auto mt-4 md:mt-0 ">
                <ul class="flex flex-col md:flex-row md:space-x-6 items-center">
                    <li><a href="#services" class="title">Services</a></li>
                    <li><a href="#top-pharmacies" class="hover:underline">Top Pharmacies</a></li>
                    <li><a href="#trending-products" class="hover:underline">Trending Products</a></li>
                </ul>
            </nav>
            <div class="flex gap-2">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center space-x-2 focus:outline-none">
                            @if (false)
                                <img src="" alt="User Avatar" class="w-10 h-10 rounded-full">
                            @else
                                <img src="/default.jpg" alt="User Avatar" class="w-10 h-10 rounded-full">
                            @endif
                            <span class="font-medium px-3">{{ auth()->user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak
                            class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg overflow-hidden z-50">
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
                @guest
                    <div class="flex gap-3">

                        <a href="{{ route('login') }}" class="btn bg-green-800 py-2 px-4 rounded-xl">Login</a>
                        <a href="{{ route('register') }}" class="btn  py-2 px-4 rounded-xl bg-green-600/100">Register</a>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-grow w-full p-6 bg-gray-100">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} {{ env('APP_NAME', 'Pharmacy') }}. All rights reserved.</p>
            <p class="text-sm">Powered by Laravel</p>
        </div>
    </footer>
</body>

</html>
