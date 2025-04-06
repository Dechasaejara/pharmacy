<!-- filepath: /home/d/coder/pharmacy/resources/views/dashboard/adminDashboard.blade.php -->
<x-dashboardLayout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 p-8">
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-emerald-400 mb-2">Welcome, Admin</h1>
            <p class="text-gray-300 text-lg">Admin Dashboard</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- User Management -->
            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <h2 class="text-xl font-semibold text-gray-100">User Management</h2>
                <p class="text-gray-400 mb-6">Manage user accounts and roles.</p>
                <a href="{{ route('profiles.index') }}" class="primary-button">Manage Users</a>
            </div>

            <!-- Pharmacy Management -->
            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <h2 class="text-xl font-semibold text-gray-100">Pharmacies</h2>
                <p class="text-gray-400 mb-6">Manage pharmacy branches and operations.</p>
                <a href="{{ route('pharmacies.index') }}" class="primary-button">Manage Pharmacies</a>
            </div>
        </div>
    </div>
</x-dashboardLayout>