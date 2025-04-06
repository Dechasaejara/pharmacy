<!-- filepath: /home/d/coder/pharmacy/resources/views/inventories/index.blade.php -->
<x-dashboardLayout :title="'Inventories'" :breadcrumb="['Inventories' => route('inventories.index')]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Inventory Management</h1>

        <!-- Add Inventory Button -->
        <div class="mb-4">
            <a href="{{ route('inventories.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                Add New Inventory
            </a>
        </div>

        <!-- Inventory Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Pharmacy</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Product</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Batch Number</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Manufacturer</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Expiry Date</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Quantity</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Unit Price</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Tax</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Storage Location</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Active</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->pharmacy_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->product_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->batch_number }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->manufacturer }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->expiry_date }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->quantity }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->unit_price }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->tax }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->storage_location }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $inventory->is_active ? 'Yes' : 'No' }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <a href="{{ route('inventories.edit', $inventory->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this inventory?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $inventories->links() }}
            </div>
        </div>
    </div>
</x-dashboardLayout>