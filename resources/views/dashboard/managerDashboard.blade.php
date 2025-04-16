<x-dashboardLayout :title="'Manager Dashboard'" :breadcrumb="['Dashboard' => route('dashboard')]">
    <div class="min-h-screen bg-gray-50 p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100">
                <h1 class="text-3xl font-semibold text-gray-800 mb-2">Welcome, {{ auth()->user()->name }}</h1>
                <p class="text-gray-600 text-lg">Your centralized manager dashboard</p>
            </div>
        </div>

        <!-- Tab Container -->
        <div x-data="{ activeTab: 'overview' }">
            <!-- Tab Navigation -->
            <div class="mb-6">
                <div class="flex space-x-3 border-b border-gray-200">
                    <button 
                        @click="activeTab = 'overview'" 
                        class="px-4 py-2 text-sm font-medium rounded-t-lg transition-colors" 
                        :class="{ 'bg-emerald-600 text-white': activeTab === 'overview', 'text-gray-600 hover:text-emerald-600': activeTab !== 'overview' }"
                    >
                        Overview
                    </button>
                    <button 
                        @click="activeTab = 'pharmacies'" 
                        class="px-4 py-2 text-sm font-medium rounded-t-lg transition-colors" 
                        :class="{ 'bg-emerald-600 text-white': activeTab === 'pharmacies', 'text-gray-600 hover:text-emerald-600': activeTab !== 'pharmacies' }"
                    >
                        Pharmacies
                    </button>
                    <button 
                        @click="activeTab = 'products'" 
                        class="px-4 py-2 text-sm font-medium rounded-t-lg transition-colors" 
                        :class="{ 'bg-emerald-600 text-white': activeTab === 'products', 'text-gray-600 hover:text-emerald-600': activeTab !== 'products' }"
                    >
                        Products
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <!-- Overview Tab -->
            <div x-show="activeTab === 'overview'" class="max-h-[70vh] overflow-y-auto">
                <!-- Statistics Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
                    <!-- Total Pharmacies -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <h3 class="text-sm font-semibold text-gray-600">Total Pharmacies</h3>
                        <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalPharmacies ?? 'N/A' }}</p>
                    </div>

                    <!-- Total Products -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <h3 class="text-sm font-semibold text-gray-600">Total Products</h3>
                        <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalProducts ?? 'N/A' }}</p>
                    </div>

                    <!-- Total Prescriptions -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <h3 class="text-sm font-semibold text-gray-600">Total Prescriptions</h3>
                        <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalPrescriptions ?? 'N/A' }}</p>
                    </div>

                    <!-- Total Transactions -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <h3 class="text-sm font-semibold text-gray-600">Total Transactions</h3>
                        <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalTransactions ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Quick Actions Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Manage Pharmacies -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 transform hover:scale-[1.01]">
                        <div class="flex items-center mb-4">
                            <div class="bg-emerald-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Pharmacies</h2>
                        </div>
                        <p class="text-gray-500 text-sm mb-4">Manage pharmacy registrations and details.</p>
                        <a href="{{ route('pharmacies.index') }}"
                            class="inline-flex items-center bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                            <span>Manage Pharmacies</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Manage Products -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 transform hover:scale-[1.01]">
                        <div class="flex items-center mb-4">
                            <div class="bg-emerald-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Products</h2>
                        </div>
                        <p class="text-gray-500 text-sm mb-4">Oversee product listings and inventory.</p>
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                            <span>Manage Products</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <!-- View Profiles -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 transform hover:scale-[1.01]">
                        <div class="flex items-center mb-4">
                            <div class="bg-emerald-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Profiles</h2>
                        </div>
                        <p class="text-gray-500 text-sm mb-4">Review and update user profiles.</p>
                        <a href="{{ route('profiles.index') }}"
                            class="inline-flex items-center bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                            <span>View Profiles</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pharmacies Tab -->
            <div x-show="activeTab === 'pharmacies'" class="max-h-[70vh] overflow-y-auto">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Pharmacy Management</h2>
                    <p class="text-gray-500 mb-6">View and manage all registered pharmacies.</p>
                    <a href="{{ route('pharmacies.index') }}"
                        class="inline-flex items-center bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>Go to Pharmacies</span>
                    </a>
                </div>
            </div>

            <!-- Products Tab -->
            <div x-show="activeTab === 'products'" class="max-h-[70vh] overflow-y-auto">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Product Management</h2>
                    <p class="text-gray-500 mb-6">Manage product inventory and details.</p>
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4"/>
                        </svg>
                        <span>Go to Products</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-dashboardLayout>