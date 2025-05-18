<!-- filepath: /home/d/coder/pharmacy/resources/views/inventories/create.blade.php -->
<x-dashboardLayout :title="'Add Inventory'" :breadcrumb="['Inventories' => route('inventories.index'), 'Create' => null]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Inventory</h1>

        <form action="{{ route('inventories.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf

            <!-- Grid Layout for Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pharmacy ID -->
                {{-- <div>
                    <label for="pharmacy_id" class="block text-sm font-medium text-gray-700 mb-1">Pharmacy</label>
                    <select id="pharmacy_id" name="pharmacy_id"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('pharmacy_id') border-red-500 @enderror">
                        <option value="">Select a Pharmacy</option>
                        @foreach ($pharmacies as $pharmacy)
                            <option value="{{ $pharmacy->id }}" {{ old('pharmacy_id') == $pharmacy->id ? 'selected' : '' }}>
                                {{ $pharmacy->name }} ({{ $pharmacy->location }})
                            </option>
                        @endforeach
                    </select>
                    @error('pharmacy_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Product ID -->
                <div>
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                    <select id="product_id" name="product_id"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('product_id') border-red-500 @enderror">
                        <option value="">Select a Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->generic_name }} ({{ $product->brand_name }})
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Batch Number -->
                <div>
                    <label for="batch_number" class="block text-sm font-medium text-gray-700 mb-1">Batch Number</label>
                    <input type="text" id="batch_number" name="batch_number" value="{{ old('batch_number') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('batch_number') border-red-500 @enderror">
                    @error('batch_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Manufacturer -->
                <div>
                    <label for="manufacturer" class="block text-sm font-medium text-gray-700 mb-1">Manufacturer</label>
                    <input type="text" id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('manufacturer') border-red-500 @enderror">
                    @error('manufacturer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expiry Date -->
                <div>
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                    <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('expiry_date') border-red-500 @enderror">
                    @error('expiry_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Quantity -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('quantity') border-red-500 @enderror">
                    @error('quantity')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unit Price -->
                <div>
                    <label for="unit_price" class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
                    <input type="number" step="0.01" id="unit_price" name="unit_price" value="{{ old('unit_price') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('unit_price') border-red-500 @enderror">
                    @error('unit_price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tax -->
                <div>
                    <label for="tax" class="block text-sm font-medium text-gray-700 mb-1">Tax</label>
                    <input type="number" step="0.01" id="tax" name="tax" value="{{ old('tax') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('tax') border-red-500 @enderror">
                    @error('tax')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Storage Location -->
                <div>
                    <label for="storage_location" class="block text-sm font-medium text-gray-700 mb-1">Storage Location</label>
                    <input type="text" id="storage_location" name="storage_location" value="{{ old('storage_location') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('storage_location') border-red-500 @enderror">
                    @error('storage_location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active -->
                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 mb-1">Active</label>
                    <select id="is_active" name="is_active" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('is_active') border-red-500 @enderror">
                        <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('is_active')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('inventories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Add Inventory
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>