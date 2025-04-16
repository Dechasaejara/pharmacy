<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Pharmacy Dashboard') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen max-w-screen bg-gray-50 font-sans">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-gray-100 flex flex-col shadow-lg">
        <div class="p-6 flex items-center space-x-3">
            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <h1 class="text-2xl font-semibold text-emerald-400">Pharma</h1>
        </div>
        <nav class="mt-6 px-3 flex-1 overflow-y-auto">
            <ul class="space-y-2">
                <!-- Common Navigation -->
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                        <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h11M9 21V3m0 0l-7 7m7-7l7 7" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <!-- Role-Based Navigation -->
                @if (auth()->user()->profile->role === 'Admin')
                    <li>
                        <a href="{{ route('profiles.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('profiles.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profiles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pharmacies.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('pharmacies.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Pharmacies
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4" />
                            </svg>
                            Products
                        </a>
                    </li>
                @endif

                @if (auth()->user()->profile->role === 'Pharmacist')
                    <li>
                        <a href="{{ route('prescriptions.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('prescriptions.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Prescriptions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('inventories.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('inventories.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M10 14h4M4 18h16" />
                            </svg>
                            Inventory
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quotations.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('quotations.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4" />
                            </svg>
                            Quotations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('transactions.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Transactions
                        </a>
                    </li>
                @endif

                @if (auth()->user()->profile->role === 'User' || auth()->user()->profile->role === 'Patient')
                    <li>
                        <a href="{{ route('prescriptions.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('prescriptions.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Prescriptions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quotations.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('quotations.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4" />
                            </svg>
                            Quotations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('transactions.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Transactions
                        </a>
                    </li>
                @endif

                @if (auth()->user()->profile->role === 'Manager')
                    <li>
                        <a href="{{ route('profiles.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('profiles.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profiles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pharmacies.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('pharmacies.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Pharmacies
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4" />
                            </svg>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('prescriptions.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('prescriptions.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Prescriptions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('inventories.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('inventories.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M10 14h4M4 18h16" />
                            </svg>
                            Inventory
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quotations.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('quotations.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4" />
                            </svg>
                            Quotations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('transactions.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-emerald-300' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Transactions
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm p-4 sticky top-0 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <!-- Breadcrumb -->
                    <nav class="text-sm text-gray-600 mt-1">
                        <ol class="list-reset flex items-center space-x-2">
                            <li>
                                <a href="{{ route('home') }}"
                                    class="text-emerald-600 hover:text-emerald-800 transition-colors">Home</a>
                                <span class="text-gray-400">/</span>
                                <a href="{{ route('dashboard') }}"
                                    class="text-emerald-600 hover:text-emerald-800 transition-colors">Dashboard</a>
                                </li酷 @isset($breadcrumb) @foreach ($breadcrumb as $name => $url)
                            <li class="flex items-center">
                                <span class="text-gray-400 mx-2">/</span>
                                @if ($url)
                                    <a href="{{ $url }}"
                                        class="text-emerald-600 hover:text-emerald-800 transition-colors">{{ $name }}</a>
                                @else
                                    <span class="text-gray-700 font-medium">{{ $name }}</span>
                                @endif
                            </li>
                            @endforeach
                        @endisset
                    </ol>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 font-medium">Hi,
                    <a href="{{ route('profiles.edit', auth()->user()->profile) }}"
                        class="text-emerald-600 hover:text-emerald-800 transition-colors">
                        {{ auth()->user()->name }}
                    </a>
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-grow p-6 bg-gray-50 overflow-y-auto">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 text-center py-4">
        <p>© {{ date('Y') }} Pharmacy Management System. All rights reserved.</p>
    </footer>
</div>
<!-- Scripts Section -->
@stack('scripts')
<x-toast />
</body>

</html>
