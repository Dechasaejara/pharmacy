<x-dashboardLayout :title="'Products'" :breadcrumb="['Products' => route('products.index')]">
    <div class="w-full">
        <h1 class="text-2xl font-bold mb-6">Product Management</h1>

        <!-- Add Product Button -->
        <div class="mb-4">
            <a href="{{ route('products.create') }}" 
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Add New Product
            </a>
        </div>

        <!-- Product Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Generic Name</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Brand Name</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Description</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Picture</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $product->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $product->generic_name }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $product->brand_name }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $product->description }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                @if ($product->picture)
                                    <img src="{{ asset('storage/' . $product->picture) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-500">No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <a href="{{ route('products.edit', $product->id) }}" 
                                   class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:underline"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$products->links()  }}
        </div>
    </div>
</x-dashboardLayout>
