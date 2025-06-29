<!-- filepath: /home/d/coder/pharmacy/resources/views/prescriptions/create.blade.php -->
<x-dashboardLayout :title="'Add Prescription'" :breadcrumb="['Prescriptions' => route('prescriptions.index'), 'Create' => null]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Prescription</h1>

        <form action="{{ route('prescriptions.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf


            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <input type="text" id="status" name="status" value="{{ old('status') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('status') border-red-500 @enderror" required>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Medical Notes -->
            <div>
                <label for="medical_notes" class="block text-sm font-medium text-gray-700 mb-1">Medical Notes</label>
                <textarea id="medical_notes" name="medical_notes" rows="4"
                          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('medical_notes') border-red-500 @enderror">{{ old('medical_notes') }}</textarea>
                @error('medical_notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Issued Date -->
            <div>
                <label for="issued_date" class="block text-sm font-medium text-gray-700 mb-1">Issued Date</label>
                <input type="date" id="issued_date" name="issued_date" value="{{ old('issued_date') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('issued_date') border-red-500 @enderror">
                @error('issued_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Images -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" id="image" name="image" multiple
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('images') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('prescriptions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Add Prescription
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>