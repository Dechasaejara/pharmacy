<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', ' Dashboard') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Optional: Add a subtle scrollbar style for Webkit browsers if desired */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* gray-300 */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; /* gray-400 */
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false, profileDropdownOpen: false }">
    <div class="flex h-screen overflow-hidden p-1">
        <!-- Sidebar -->
        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-gray-100 transform lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300 ease-in-out flex flex-col shadow-xl"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
        >
            <!-- Sidebar Header -->
            <div class="p-5 flex items-center space-x-3 border-b border-gray-700 flex-shrink-0">
                @if(Auth::check() && Auth::user()->profile && in_array(Auth::user()->profile->role, ['Manager', 'Pharmacist']) && Auth::user()->profile->pharmacy)
                    @if(Auth::user()->profile->pharmacy->picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile->pharmacy->picture) }}" alt="{{ Auth::user()->profile->pharmacy->name }} Logo" class="h-10 w-10 object-cover rounded-full flex-shrink-0 border-2 border-emerald-500">
                    @else
                        <span class="flex items-center justify-center h-10 w-10 bg-emerald-600 text-white rounded-full text-md font-semibold flex-shrink-0 border-2 border-emerald-500" title="{{ Auth::user()->profile->pharmacy->name }}">
                            {{ strtoupper(substr(Auth::user()->profile->pharmacy->name, 0, 1)) }}
                        </span>
                    @endif
                    <h1 class="text-lg font-semibold text-emerald-400 overflow-hidden text-ellipsis whitespace-nowrap" style="max-width: 160px;" title="{{ Auth::user()->profile->pharmacy->name }}">
                        {{ Auth::user()->profile->pharmacy->name }}
                    </h1>
                @else
                    <svg class="w-10 h-10 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h1 class="text-lg font-semibold text-emerald-400">
                        {{ env('APP_NAME', 'Pharmacy') }}
                    </h1>
                @endif
            </div>
            <!-- End of Sidebar Header -->

            <!-- Sidebar Navigation -->
            <nav class="mt-4 px-3 flex-1 overflow-y-auto space-y-1">
                {{-- Reusable Nav Link Component (Conceptual - for cleaner repeated structure) --}}
                @php
                $navLinkClasses = "flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group";
                $activeClasses = "bg-emerald-600 text-white shadow-md";
                $inactiveClasses = "text-gray-300 hover:bg-gray-700 hover:text-emerald-300";
                $iconClasses = "w-5 h-5 mr-3 text-emerald-400 group-hover:text-emerald-300";
                $activeIconClasses = "text-white"; // For active link icons
                @endphp

                <a href="{{ route('dashboard') }}"
                    class="{{ $navLinkClasses }} {{ request()->routeIs('dashboard') ? $activeClasses : $inactiveClasses }}">
                    <svg class="{{ $iconClasses }} {{ request()->routeIs('dashboard') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0l-7 7m7-7l7 7" />
                    </svg>
                    Dashboard
                </a>

                @if (Auth::check() && Auth::user()->profile)
                    @if (Auth::user()->profile->role === 'Admin')
                        <a href="{{ route('profiles.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('profiles.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('profiles.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg> Profiles
                        </a>
                        <a href="{{ route('pharmacies.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('pharmacies.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('pharmacies.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg> Pharmacies
                        </a>
                        <a href="{{ route('products.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('products.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('products.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4" />
                            </svg> Products
                        </a>
                    @endif
                    {{-- Add other roles similarly using the $navLinkClasses, $activeClasses, etc. --}}
                    @if (Auth::user()->profile->role === 'Pharmacist')
                        <a href="{{ route('prescriptions.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('prescriptions.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('prescriptions.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Prescriptions
                        </a>
                        <a href="{{ route('inventories.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('inventories.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('inventories.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M10 14h4M4 18h16"></path></svg>
                            Inventory
                        </a>
                        <a href="{{ route('quotations.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('quotations.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('quotations.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4"></path></svg>
                            Quotations
                        </a>
                        <a href="{{ route('transactions.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('transactions.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('transactions.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Transactions
                        </a>
                    @endif

                    @if (in_array(Auth::user()->profile->role, ['User', 'Patient']))
                        <a href="{{ route('prescriptions.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('prescriptions.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('prescriptions.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            My Prescriptions
                        </a>
                        <a href="{{ route('quotations.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('quotations.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('quotations.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4"></path></svg>
                            My Quotations
                        </a>
                        <a href="{{ route('transactions.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('transactions.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('transactions.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            My Transactions
                        </a>
                    @endif

                    @if (Auth::user()->profile->role === 'Manager')
                         <a href="{{ route('profiles.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('profiles.index') || request()->routeIs('profiles.showAssignPharmacistForm') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('profiles.index') || request()->routeIs('profiles.showAssignPharmacistForm') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 016-6h6a6 6 0 016 6v1h-3"></path></svg>
                            Staff Profiles
                        </a>
                        @if(Auth::user()->profile->pharmacy_id)
                        <a href="{{ route('pharmacies.edit', Auth::user()->profile->pharmacy_id) }}" class="{{ $navLinkClasses }} {{ request()->routeIs('pharmacies.edit') && request()->route('pharmacy') && request()->route('pharmacy')->id == Auth::user()->profile->pharmacy_id ? $activeClasses : $inactiveClasses }}">
                             <svg class="{{ $iconClasses }} {{ request()->routeIs('pharmacies.edit') && request()->route('pharmacy') && request()->route('pharmacy')->id == Auth::user()->profile->pharmacy_id ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            My Pharmacy
                        </a>
                        @endif
                        <a href="{{ route('prescriptions.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('prescriptions.*') ? $activeClasses : $inactiveClasses }}">
                           <svg class="{{ $iconClasses }} {{ request()->routeIs('prescriptions.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Prescriptions
                        </a>
                        <a href="{{ route('inventories.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('inventories.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('inventories.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M10 14h4M4 18h16"></path></svg>
                            Inventory
                        </a>
                        <a href="{{ route('quotations.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('quotations.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('quotations.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4"></path></svg>
                            Quotations
                        </a>
                        <a href="{{ route('transactions.index') }}" class="{{ $navLinkClasses }} {{ request()->routeIs('transactions.*') ? $activeClasses : $inactiveClasses }}">
                            <svg class="{{ $iconClasses }} {{ request()->routeIs('transactions.*') ? $activeIconClasses : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Transactions
                        </a>
                    @endif
                @endif
            </nav>
            <!-- End of Sidebar Navigation -->
        </aside>
        <!-- End Sidebar -->

        <!-- Overlay for mobile sidebar -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Content area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="bg-white shadow-md sticky top-0 z-10">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Hamburger menu button for mobile -->
                        <div class="lg:hidden">
                            <button @click.stop="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>

                        <!-- Breadcrumbs - aligned to left or center if no hamburger-->
                        <div class="flex-1 flex items-center">
                            <nav class="text-sm text-gray-600 hidden sm:block">
                                <ol class="list-reset flex items-center">
                                    <li>
                                        <a href="{{ route('home') }}" class="text-emerald-600 hover:text-emerald-800 transition-colors duration-150">Home</a>
                                    </li>
                                    <li><span class="text-gray-400 mx-2">/</span></li>
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="text-emerald-600 hover:text-emerald-800 transition-colors duration-150">Dashboard</a>
                                    </li>
                                    @isset($breadcrumb)
                                        @foreach ($breadcrumb as $name => $url)
                                            <li class="flex items-center">
                                                <span class="text-gray-400 mx-2">/</span>
                                                @if ($url)
                                                    <a href="{{ $url }}" class="text-emerald-600 hover:text-emerald-800 transition-colors duration-150">{{ $name }}</a>
                                                @else
                                                    <span class="text-gray-500 font-medium">{{ $name }}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    @endisset
                                </ol>
                            </nav>
                        </div>

                        <!-- User menu -->
                        @if (Auth::check() && Auth::user()->profile)
                        <div class="relative" @click.away="profileDropdownOpen = false">
                            <button @click="profileDropdownOpen = !profileDropdownOpen" class="flex items-center space-x-2 p-2 rounded-full hover:bg-gray-100 focus:outline-none transition duration-150">
                                <span class="text-gray-700 font-medium text-sm hidden sm:inline">Hi, {{ Str::words(Auth::user()->name, 1, '') }}</span>
                                @if (Auth::user()->profile->picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile->picture) }}" alt="{{ Auth::user()->profile->name }} Logo" class="h-10 w-10 object-cover rounded-full flex-shrink-0 border-2 border-emerald-500">
                                    
                                @else
                                <span class="flex items-center justify-center h-8 w-8 bg-emerald-500 text-white rounded-full text-xs font-semibold flex-shrink-0" title="{{ Auth::user()->name }}">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                @endif
                                {{-- <img src="{{ asset('storage/' . Auth::user()->profile->picture) }}" alt="{{ Auth::user()->profile->name }} Logo" class="h-10 w-10 object-cover rounded-full flex-shrink-0 border-2 border-emerald-500"> --}}
                              
                                <svg class="h-4 w-4 text-gray-500 hidden sm:inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <div x-show="profileDropdownOpen" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 origin-top-right bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-20">
                                <div class="px-4 py-3">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->profile->role }}</p>
                                </div>
                                <div class="border-t border-gray-100"></div>
                                <a href="{{ route('profiles.edit', Auth::user()->profile->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-emerald-600">My Profile</a>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </header>
            <!-- End Top bar -->

            <!-- Main content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-gray-100">
                <div class="container mx-auto">
                    {{-- Slot content will be placed here --}}
                    {{-- Example of how content might be structured for better visual appeal:
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Page Title</h1>
                        {{ $slot }}
                    </div>
                    --}}
                     {{ $slot }}
                </div>
            </main>
            <!-- End Main content -->

            <!-- Footer -->
            <footer class="bg-gray-800 text-gray-400 text-center py-4 flex-shrink-0 border-t border-gray-700">
                <p class="text-xs sm:text-sm">© {{ date('Y') }}
                    @if(Auth::check() && Auth::user()->profile && in_array(Auth::user()->profile->role, ['Manager', 'Pharmacist']) && Auth::user()->profile->pharmacy)
                        {{ Auth::user()->profile->pharmacy->name }}
                    @else
                        {{ env('APP_NAME', 'Pharmacy App') }}
                    @endif. All rights reserved.
                </p>
            </footer>
            <!-- End Footer -->
        </div>
        <!-- End Content area -->
    </div>

    @stack('scripts')
    <x-toast />
</body>
</html>