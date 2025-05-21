<x-dashboardLayout :title="'Manager Dashboard'" :breadcrumb="['Dashboard' => route('dashboard')]">
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 p-8">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="backdrop-blur-lg bg-white/10 p-8 rounded-2xl shadow-2xl border border-white/10">
                <h1 class="text-4xl font-bold text-emerald-400 mb-2">Welcome, {{ auth()->user()->name }}</h1>
                <p class="text-gray-300 text-lg">Your personalized manager dashboard for {{ $assignedPharmacy->name }}</p>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
            <!-- Total Prescriptions -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Prescriptions</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalPrescriptions }}</p>
                <a href="{{ route('prescriptions.index') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    View Prescriptions
                </a>
            </div>

            <!-- Total Quotations -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Quotations</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalQuotations }}</p>
                <a href="{{ route('quotations.index') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    View Quotations
                </a>
            </div>

            <!-- Total Transactions -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Transactions</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalTransactions }}</p>
                <a href="{{ route('transactions.index') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    View Transactions
                </a>
            </div>

            <!-- Total Inventories -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Inventories</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalInventories }}</p>
                <a href="{{ route('inventories.index') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    View Inventories
                </a>
            </div>

            <!-- Total Products -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Products</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalProducts }}</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    View Products
                </a>
            </div>

            <!-- Total Profiles -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Profiles</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalProfiles }}</p>
                <a href="{{ route('profiles.index') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    View Profiles
                </a>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Manage Prescriptions -->
            <div class="group bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">Prescriptions</h2>
                </div>
                <p class="text-gray-400 mb-6">Manage and review prescriptions.</p>
                <a href="{{ route('prescriptions.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>Manage Prescriptions</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Manage Quotations -->
            <div class="group bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">Quotations</h2>
                </div>
                <p class="text-gray-400 mb-6">Manage and review quotations.</p>
                <a href="{{ route('quotations.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>Manage Quotations</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Manage Inventories -->
            <div class="group bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">Inventories</h2>
                </div>
                <p class="text-gray-400 mb-6">Manage and track inventories.</p>
                <a href="{{ route('inventories.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>Manage Inventories</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-dashboardLayout>