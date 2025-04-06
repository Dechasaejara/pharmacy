<!-- filepath: /home/d/coder/pharmacy/resources/views/transactions/index.blade.php -->
<x-dashboardLayout :title="'Transactions'" :breadcrumb="['Transactions' => route('transactions.index')]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Transaction Management</h1>

        <!-- Add Transaction Button -->
        <div class="mb-4">
            <a href="{{ route('transactions.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                Add New Transaction
            </a>
        </div>

        <!-- Transaction Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Quotation ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Profile ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Pharmacy ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Total Amount</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Status</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Completed At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $transaction->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $transaction->quotation_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $transaction->profile_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $transaction->pharmacy_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $transaction->total_amount }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $transaction->status }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $transaction->completed_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-dashboardLayout>