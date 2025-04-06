<!-- filepath: /home/d/coder/pharmacy/resources/views/product/edit.blade.php -->
<x-dashboardLayout :title="'Edit Product'" :breadcrumb="['Products' => route('products.index'), 'Edit' => null]">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <!-- Generic Name -->
            <div class="mb-4">
                <label for="generic_name" class="block text-gray-700 font-medium mb-2">Generic Name</label>
                <input type="text" id="generic_name" name="generic_name" value="{{ old('generic_name', $product->generic_name) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('generic_name') border-red-500 @enderror" required>
                @error('generic_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Brand Name -->
            <div class="mb-4">
                <label for="brand_name" class="block text-gray-700 font-medium mb-2">Brand Name</label>
                <input type="text" id="brand_name" name="brand_name" value="{{ old('brand_name', $product->brand_name) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('brand_name') border-red-500 @enderror">
                @error('brand_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Picture -->
            <div class="mb-4">
                <label for="picture" class="block text-gray-700 font-medium mb-2">Picture</label>
                <input type="file" id="picture" name="picture"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-500 @error('picture') border-red-500 @enderror">
                @if ($product->picture)
                    <img src="{{ asset('storage/' . $product->picture) }}" alt="Product Image" class="w-16 h-16 mt-2">
                @endif
                @error('picture')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-500">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>