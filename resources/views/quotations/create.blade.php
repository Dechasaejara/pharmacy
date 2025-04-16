<!-- filepath: /home/d/coder/pharmacy/resources/views/quotations/create.blade.php -->
<x-dashboardLayout :title="'Add Quotation'" :breadcrumb="['Quotations' => route('quotations.index'), 'Create' => null]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Quotation</h1>

        <form action="{{ route('quotations.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf

            <!-- Prescription ID -->

            <div>
                <label for="prescription_id" class="block text-sm font-medium text-gray-700 mb-1">Prescription</label>
                <select id="prescription_id" name="prescription_id"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('pharmacy_id') border-red-500 @enderror">
                    <option value="">Select a prescription</option>
                    @foreach ($prescriptions as $prescription)
                        <option value="{{ $prescription->id }}"
                            {{ old('prescription_id') == $prescription->id ? 'selected' : '' }}>
                            {{ $prescription->unique_name }}
                        </option>
                    @endforeach
                </select>
                @error('pharmacy_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="pharmacy_id" class="block text-sm font-medium text-gray-700 mb-1">Pharmacy</label>
                <select id="pharmacy_id" name="pharmacy_id"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('pharmacy_id') border-red-500 @enderror">
                    <option value="{{auth()->user()->profile->pharmacy  }}"  >Select a Pharmacy</option>
                    @foreach ($pharmacies as $pharmacy)
                        <option disabled value="{{ $pharmacy->id }}" {{ old('pharmacy_id') == $pharmacy->id ? 'selected' : '' }}>
                            {{ $pharmacy->name }}
                        </option>
                    @endforeach
                </select>
                @error('pharmacy_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Profile ID -->
            <div>
                <label for="profile_id" class="block text-sm font-medium text-gray-700 mb-1">Pharmacist</label>
                <input type="text" id="profile_id" name="profile_id"
                    value="{{ old('profile_id', auth()->user()->profile->id) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('profile_id') border-red-500 @enderror"
                    disabled>
                @error('profile_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Total Amount -->
            <div>
                <label for="total_amount" class="block text-sm font-medium text-gray-700 mb-1">Total Amount</label>
                <input type="number" step="0.01" id="total_amount" name="total_amount"
                    value="{{ old('total_amount') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('total_amount') border-red-500 @enderror"
                    required>
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

            <!-- Valid Until -->
            <div>
                <label for="valid_until" class="block text-sm font-medium text-gray-700 mb-1">Valid Until</label>
                <input type="date" id="valid_until" name="valid_until" value="{{ old('valid_until') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('valid_until') border-red-500 @enderror">
                @error('valid_until')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                <textarea id="notes" name="notes" rows="4"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('quotations.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</a>
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Add Quotation
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>
