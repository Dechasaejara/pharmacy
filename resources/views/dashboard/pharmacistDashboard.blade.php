<x-dashboardLayout>
    @php
        // Pharmacy name and logo should be displayed (handled in dashboardLayout) [cite: 4]
        // Data for this dashboard could include pending prescriptions, low stock items, etc.
        // $pendingPrescriptionsCount = ...
        // $lowStockItemCount = ...
    @endphp
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 p-8">
        <div class="mb-10 backdrop-blur-lg bg-white/10 p-8 rounded-2xl shadow-2xl border border-white/10">
            @if(Auth::user()->profile && Auth::user()->profile->pharmacy)
                <h1 class="text-3xl font-bold text-emerald-400 mb-1">
                    {{ Auth::user()->profile->pharmacy->name }} - Pharmacist Dashboard
                </h1>
                 <p class="text-gray-300 text-lg">Welcome, {{ Auth::user()->name }}</p>
            @else
                <h1 class="text-4xl font-bold text-emerald-400 mb-2">Pharmacist Dashboard</h1>
                <p class="text-gray-300 text-lg">Welcome, {{ Auth::user()->name }} (Pharmacy not assigned)</p>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-3">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4"><svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></div>
                    <h2 class="text-xl font-semibold text-gray-100">Prescriptions</h2>
                </div>
                <p class="text-gray-400 mb-4 text-sm">Accept/reject new prescriptions[cite: 1], view history. Patient name displayed instead of ID. [cite: 4]</p>
                <a href="{{ route('prescriptions.index') }}" class="primary-button text-sm">Manage Prescriptions</a>
            </div>

            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                 <div class="flex items-center mb-3">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4"><svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10m16-10v10M4 7h16m-4 10V7M8 7v10m4-5h4"></path></svg></div>
                    <h2 class="text-xl font-semibold text-gray-100">Inventory</h2>
                </div>
                <p class="text-gray-400 mb-4 text-sm">Add products to inventory (auto-links to your pharmacy)[cite: 1, 4], manage stock levels.</p>
                <a href="{{ route('inventories.index') }}" class="primary-button text-sm">Manage Inventory</a>
            </div>

            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-3">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4"><svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8m-8-4h8m-8-4h8m-2 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m4 4v-4"></path></svg></div>
                    <h2 class="text-xl font-semibold text-gray-100">Quotations</h2>
                </div>
                <p class="text-gray-400 mb-4 text-sm">Create and manage quotations for customers. [cite: 1] Pharmacy ID auto-set; 'valid until' follows policy. [cite: 4]</p>
                <a href="{{ route('quotations.index') }}" class="primary-button text-sm">Manage Quotations</a>
            </div>

            <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                 <div class="flex items-center mb-3">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4"><svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                    <h2 class="text-xl font-semibold text-gray-100">Transactions</h2>
                </div>
                <p class="text-gray-400 mb-4 text-sm">Create transactions based on quotations[cite: 1], view transaction history for your pharmacy.</p>
                <a href="{{ route('transactions.index') }}" class="primary-button text-sm">View/Create Transactions</a>
            </div>

            {{-- <div class="group backdrop-blur-sm bg-white/5 hover:bg-white/10 p-6 rounded-xl shadow-xl border border-white/10 hover:border-emerald-400/30 transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center mb-3">
                    <div class="bg-emerald-500/20 p-3 rounded-lg mr-4"><svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></div>
                    <h2 class="text-xl font-semibold text-gray-100">Medical Notes</h2>
                </div>
                <p class="text-gray-400 mb-4 text-sm">Provide medical notes or advice related to prescriptions. [cite: 1]</p>
                <a href="#" {{-- route('medicalnotes.index') --}} {{-- class="primary-button text-sm">Manage Notes</a>
            </div> --}}
        </div>
        <style>
            .primary-button {
                display: inline-block;
                padding: 0.5rem 1rem; /* Reduced padding for text-sm */
                background-color: rgba(16, 185, 129, 0.3); /* bg-emerald-600/30 */
                color: #6EE7B7; /* text-emerald-300 */
                border-radius: 0.375rem; /* rounded-lg */
                transition: all 0.2s ease-in-out;
                text-decoration: none;
            }
            .primary-button:hover {
                background-color: rgba(5, 150, 105, 0.4); /* hover:bg-emerald-500/40 */
                color: white; /* hover:text-white */
            }
        </style>
    </div>
</x-dashboardLayout>