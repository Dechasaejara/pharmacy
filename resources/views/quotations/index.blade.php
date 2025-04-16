<!-- filepath: /home/d/coder/pharmacy/resources/views/quotations/index.blade.php -->
<x-dashboardLayout :title="'Quotations'" :breadcrumb="['Quotations' => route('quotations.index')]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Quotation Management</h1>
        @if (auth()->user()->profile->role === 'Pharmacist')
            <!-- Add Quotation Button -->
            <div class="mb-4">
                <a href="{{ route('quotations.create') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Add New Quotation
                </a>
            </div>
        @endif


        <!-- Quotation Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Prescription ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Profile ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Pharmacy ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Total Amount</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Status</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Valid Until</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Notes</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotations as $quotation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $quotation->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $quotation->prescription_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $quotation->profile_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $quotation->pharmacy_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $quotation->total_amount }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $quotation->status }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $quotation->valid_until }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ strlen($quotation->notes) > 20 ? substr($quotation->notes, 0, 20) . '...' : $quotation->notes }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                @if (auth()->user()->profile->role === 'Pharmacist')
                                    <a href="{{ route('quotations.edit', $quotation->id) }}"
                                        class="text-blue-500 hover:underline">Edit</a>
                                    <form action="{{ route('quotations.destroy', $quotation->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline"
                                            onclick="return confirm('Are you sure you want to delete this quotation?')">
                                            Delete
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $quotations->links() }}
            </div>

        </div>
        <div class="mt-2">
            @if ($quotations->count() > 0)
            
            <div class="mb-10">
                <x-map :quotations="$quotations->items()" />
                
            </div>
            
        @endif
        </div>
        <!-- Map -->
 
    </div>
</x-dashboardLayout>
