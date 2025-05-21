<x-dashboardLayout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 p-8">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="backdrop-blur-lg bg-white/10 p-8 rounded-2xl shadow-2xl border border-white/10">
                <h1 class="text-4xl font-bold text-emerald-400 mb-2">Welcome, Admin</h1>
                <p class="text-gray-300 text-lg">Your personalized admin dashboard</p>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
            <!-- Total Pharmacies -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Pharmacies</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalPharmacies }}</p>
                <a href="{{ route('pharmacies.create') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    Add New Pharmacy
                </a>
            </div>

            <!-- Total Profiles -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Managers</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalProfiles }}</p>
                {{-- <a href="{{ route('profiles.edit') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    Add New Manager
                </a> --}}
            </div>

            <!-- Total Products -->
            <div class="bg-emerald-500/20 p-6 rounded-xl shadow-xl border border-emerald-400/30">
                <h3 class="text-lg font-semibold text-emerald-300">Total Products</h3>
                <p class="text-4xl font-bold text-white mt-2">{{ $totalProducts }}</p>
                <a href="{{ route('products.create') }}" class="mt-4 inline-block bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                    Add New Product
                </a>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Manage Pharmacies -->
            <div class="group bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">Pharmacies</h2>
                </div>
                <p class="text-gray-400 mb-6">Manage pharmacy  operations.</p>
                <a href="{{ route('pharmacies.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>Manage Pharmacies</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Manage Profiles -->
            <div class="group bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">Profiles</h2>
                </div>
                <p class="text-gray-400 mb-6">Manage user accounts and roles.</p>
                <a href="{{ route('profiles.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>Manage Profiles</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Manage Products -->
            <div class="group bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-100">Products</h2>
                </div>
                <p class="text-gray-400 mb-6">Manage product and details.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center bg-emerald-600/30 hover:bg-emerald-500/40 text-emerald-300 hover:text-white px-4 py-2 rounded-lg transition-all">
                    <span>Manage Products</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-dashboardLayout>