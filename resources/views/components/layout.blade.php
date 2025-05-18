<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Head content remains unchanged -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'PharmaConnect') }} - Your Trusted Pharmacy Partner</title>

    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"> --}}
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}"> --}}
    {{-- <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}"> --}}

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="description" content="Find the best prices for your prescriptions from nearby pharmacies. Upload your prescription and get quotes easily with {{ config('app.name', 'PharmaConnect') }}.">
    <meta name="keywords" content="pharmacy, prescription, online pharmacy, medicine, health, compare prices, nearby pharmacy">

    @stack('styles')
</head>

<body class="flex flex-col min-h-screen bg-gray-100 font-sans antialiased">
    <header x-data="{ mobileMenuOpen: false }" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex flex-wrap justify-between items-center py-3 px-4 sm:px-6">
            <!-- Fixed duplicate div -->
            <div class="flex-shrink-0 flex items-center space-x-2">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <a href="/" class="text-2xl font-semibold hover:text-emerald-200 transition-colors">
                    {{ env('APP_NAME', 'Pharmacy') }}
                </a>
            </div>

            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-green-200 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen}" class="w-full md:flex md:w-auto md:items-center mt-4 md:mt-0">
                <ul class="flex flex-col md:flex-row md:space-x-6 items-start md:items-center text-lg space-y-2 md:space-y-0">
                    <li><a href="{{ route('home') }}#how-it-works" @click="mobileMenuOpen = false" class="py-2 block hover:text-green-200 transition-colors">How It Works</a></li>
                    <li><a href="{{ route('home') }}#featured-pharmacies" @click="mobileMenuOpen = false" class="py-2 block hover:text-green-200 transition-colors">Partners</a></li>
                    @if(Route::has('products.index'))
                        <li><a href="{{ route('products.index') }}" @click="mobileMenuOpen = false" class="py-2 block hover:text-green-200 transition-colors">Products</a></li>
                    @endif
                </ul>

                <div class="flex flex-col md:flex-row gap-3 items-start md:items-center md:ml-6 mt-4 md:mt-0 border-t border-green-500 md:border-none pt-4 md:pt-0">
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.outside="open = false"
                                class="flex items-center space-x-2 focus:outline-none text-white hover:text-green-200">
                                @if (auth()->user()->profile->picture)
                                    <img 
                                    src="{{ asset("storage/" . auth()->user()->profile->picture ) }}" alt="{{ auth()->user()->name }}" class="w-9 h-9 rounded-full border-2 border-green-300 object-cover">
                                @else
                                    <!-- Fixed missing quote in asset path -->
                                    <img src="default.jpg" alt="User Avatar" class="w-9 h-9 rounded-full border-2 border-green-300 object-cover">
                                @endif
                                <span class="font-medium hidden md:inline">{{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" x-cloak @click.outside="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl overflow-hidden z-50 text-sm">
                                <a href="{{ route('dashboard') }}" 
                                    class="block px-4 py-2.5 text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors">Dashboard</a>
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                    @guest
                        <div class="flex flex-col md:flex-row gap-3 items-start md:items-center w-full md:w-auto">
                            <a href="{{ route('login') }}"
                                class="bg-emerald-800 text-white py-2 px-4 rounded-md hover:bg-emerald-900 transition-colors shadow-sm w-full md:w-auto text-center">Login</a>
                            <a href="{{ route('register') }}"
                                class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-400 transition-colors shadow-sm w-full md:w-auto text-center">Register</a>
                        </div>
                    @endguest
                </div>
            </nav>
        </div>
    </header>

    <!-- Rest of the body content remains unchanged -->
    @if (session("success"))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
            class="fixed top-24 right-5 z-[100] bg-green-500 text-white py-3 px-6 rounded-lg shadow-md">
            <p>{{ session("success") }}</p>
        </div>
    @endif
    @if (session("error"))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
            class="fixed top-24 right-5 z-[100] bg-red-500 text-white py-3 px-6 rounded-lg shadow-md">
            <p>{{ session("error") }}</p>
        </div>
    @endif

    <main class="flex-grow w-full my-4">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-gray-300 py-10 lg:py-12">
        <!-- Footer content remains unchanged -->
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h5 class="text-xl font-semibold text-white mb-4">{{ config('app.name', 'PharmaConnect') }}</h5>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Your one-stop solution for comparing prescription prices and finding nearby pharmacies.
                    </p>
                </div>
                <div>
                    <h5 class="text-lg font-semibold text-white mb-4">Quick Links</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}#how-it-works" class="hover:text-white hover:underline">How It Works</a></li>
                        <li><a href="{{ route('dashboard') }}" class="hover:text-white hover:underline">Pharmacies Map</a></li>
                        <li><a href="{{ route('home') }}#featured-pharmacies" class="hover:text-white hover:underline">Partner Pharmacies</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold text-white mb-4">For Partners</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('register') }}" class="hover:text-white hover:underline">Pharmacy Registration</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white hover:underline">Partner Portal Login</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold text-white mb-4">Legal</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href='#' class="hover:text-white hover:underline">Privacy Policy</a></li>
                        <li><a href='#' class="hover:text-white hover:underline">Terms of Service</a></li>
                        <li><a href='#' class="hover:text-white hover:underline">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center">
                <p class="text-sm">&copy; {{ date('Y') }} {{ config('app.name', 'PharmaConnect') }}. All rights reserved.</p>
                <p class="text-xs mt-1 text-gray-500">Empowering Your Health Choices.</p>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>