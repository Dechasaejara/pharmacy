<!-- filepath: /home/d/coder/pharmacy/resources/views/components/dashboardLayout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Pharmacy Dashboard') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-gray-200 hidden md:flex flex-col">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-emerald-400">Pharma</h1>
        </div>
        <nav class="mt-8 px-4">
            <ul class="space-y-3">
                <!-- Common Navigation -->
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center px-4 py-2 rounded {{ request()->routeIs('home') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h11M9 21V3m0 0l-7 7m7-7l7 7" />
                        </svg>
                        Home
                    </a>
                </li>

                <!-- Role-Based Navigation -->
                @if (auth()->user()->profile->role === 'Admin')
                    <li>
                        <a href="{{ route('profiles.index') }}"
                            class="flex items-center px-4 py-2 rounded {{ request()->routeIs('profiles.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Manage Profiles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pharmacies.index') }}"
                            class="flex items-center px-4 py-2 rounded {{ request()->routeIs('pharmacies.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Manage Pharmacies
                        </a>
                    </li>
                @endif

                @if (auth()->user()->profile->role === 'Pharmacist')
                    <li>
                        <a href="{{ route('inventories.index') }}"
                            class="flex items-center px-4 py-2 rounded {{ request()->routeIs('inventories.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M10 14h4M4 18h16" />
                            </svg>
                            Manage Inventory
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.index') }}"
                            class="flex items-center px-4 py-2 rounded {{ request()->routeIs('transactions.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Transactions
                        </a>
                    </li>
                @endif

                @if (auth()->user()->profile->role === 'User' || auth()->user()->profile->role === 'Patient')
                    <li>
                        <a href="{{ route('prescriptions.index') }}"
                            class="flex items-center px-4 py-2 rounded {{ request()->routeIs('prescriptions.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
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
                            class="flex items-center px-4 py-2 rounded {{ request()->routeIs('quotations.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                            <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4" />
                            </svg>
                            Quotations
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <!-- Breadcrumb -->
                    <nav class="text-sm text-gray-500 mt-1">
                        <ol class="list-reset flex">
                            <li>
                                <a href="{{ route('home') }}" class="text-emerald-500 hover:underline">Home</a>
                                <span>/</span>
                                <a href="{{ route('dashboard') }}"
                                    class="text-emerald-500 hover:underline">Dashboard</a>
                            </li>
                            @isset($breadcrumb)
                                @foreach ($breadcrumb as $name => $url)
                                    <li><span class="mx-2">/</span></li>
                                    <li>
                                        @if ($url)
                                            <a href="{{ $url }}"
                                                class="text-emerald-500 hover:underline">{{ $name }}</a>
                                        @else
                                            <span class="text-gray-700">{{ $name }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            @endisset
                        </ol>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Hi, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 px-4 py-2 rounded-lg hover:underline">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-grow w-full p-6 bg-gray-100">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 text-center bottom-0 py-4">
            <p>&copy; {{ date('Y') }} Pharmacy Management System. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>