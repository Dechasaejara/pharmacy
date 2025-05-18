<!-- filepath: /home/d/coder/pharmacy/resources/views/transactions/create.blade.php -->
<x-dashboardLayout :title="'Add Transaction'" :breadcrumb="['Transactions' => route('transactions.index'), 'Create' => null]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Transaction</h1>

        <form action="{{ route('transactions.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf

            <!-- Quotation ID -->
           
            <div>
                <label for="quotation_id" class="block text-sm font-medium text-gray-700 mb-1">Quotation</label>
                <select id="quotation_id" name="quotation_id"
                        class="w-full border  rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('quotation_id') border-red-500 @enderror">
                    <option value="">Select a Quotation</option>
                    @foreach ($quotations as $quotation)
                        <option value="{{ $quotation->id }}" {{ old('quotation_id') == $quotation->id ? 'selected' : '' }}>
                           {{ $quotation->unique_name }}
                        </option>
                    @endforeach
                </select>
                @error('quotation_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- <!-- Profile ID -->
            <div>
                <label for="profile_id" class="block text-sm font-medium text-gray-700 mb-1">Profile ID</label>
                <input type="text" id="profile_id" name="profile_id" value="{{ old('profile_id') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('profile_id') border-red-500 @enderror" required>
                @error('profile_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            <!-- Pharmacy ID -->
            {{-- <div>
                <label for="pharmacy_id" class="block text-sm font-medium text-gray-700 mb-1">Pharmacy ID</label>
                <input type="text" id="pharmacy_id" name="pharmacy_id" value="{{ old('pharmacy_id') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('pharmacy_id') border-red-500 @enderror" required>
                @error('pharmacy_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            <!-- Total Amount -->
            <div>
                <label for="total_amount" class="block text-sm font-medium text-gray-700 mb-1">Total Amount</label>
                <input type="number" step="0.01" id="total_amount" name="total_amount" value="{{ old('total_amount') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('total_amount') border-red-500 @enderror" required>
                @error('total_amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('status') border-red-500 @enderror"
                    required>
                    <option value="approved" disabled {{ old('status') ? '' : 'selected' }}>Select status</option>
                    @foreach ([ 'approved', 'rejected', 'accepted'] as $roleOption)
                        <option value="{{ $roleOption }}" {{ old('status') === $roleOption ? 'selected' : '' }}>
                            {{ $roleOption }}</option>
                    @endforeach
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Completed At -->
            <div>
                <label for="completed_at" class="block text-sm font-medium text-gray-700 mb-1">Completed At</label>
                <input type="date" id="completed_at" name="completed_at" value="{{ old('completed_at') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('completed_at') border-red-500 @enderror">
                @error('completed_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('transactions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Add Transaction
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>