<!-- filepath: /home/d/coder/pharmacy/resources/views/dashboard/dashboard.blade.php -->
<x-dashboardLayout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 p-8">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="backdrop-blur-lg bg-white/10 p-8 rounded-2xl shadow-2xl border border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-emerald-400 mb-2">Welcome, {{ auth()->user()->name }}</h1>
                        <p class="text-gray-300 text-lg">Pharmacy Management System Control Center</p>
                    </div>
                    <div class="flex space-x-4">
                        <div class="bg-emerald-500/20 p-4 rounded-xl">
                            <span class="text-3xl font-bold text-emerald-400">5.0</span>
                            <span class="text-gray-300">System Health</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- User Management Card -->
            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">User Management</h2>
                </div>
                <p class="text-gray-400 mb-6">Oversee user profiles and access levels.</p>
                <a href="{{ route('profiles.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>Access Panel</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Product Management Card -->
            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">Product Catalog</h2>
                </div>
                <p class="text-gray-400 mb-6">Manage pharmaceutical inventory and SKUs.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>View Products</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Pharmacy Management Card -->
            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">Pharmacy Network</h2>
                </div>
                <p class="text-gray-400 mb-6">Manage branch locations and operations.</p>
                <a href="{{ route('pharmacies.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>View Branches</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Stats Footer -->
        <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="bg-emerald-500/10 p-6 rounded-xl border border-emerald-500/20">
                <div class="text-3xl font-bold text-emerald-400">24</div>
                <div class="text-sm text-gray-400 mt-1">Active Branches</div>
            </div>
            <div class="bg-emerald-500/10 p-6 rounded-xl border border-emerald-500/20">
                <div class="text-3xl font-bold text-emerald-400">1.2k</div>
                <div class="text-sm text-gray-400 mt-1">Total Products</div>
            </div>
            <div class="bg-emerald-500/10 p-6 rounded-xl border border-emerald-500/20">
                <div class="text-3xl font-bold text-emerald-400">89%</div>
                <div class="text-sm text-gray-400 mt-1">System Efficiency</div>
            </div>
            <div class="bg-emerald-500/10 p-6 rounded-xl border border-emerald-500/20">
                <div class="text-3xl font-bold text-emerald-400">256</div>
                <div class="text-sm text-gray-400 mt-1">Daily Transactions</div>
            </div>
        </div>
    </div>
</x-dashboardLayout>