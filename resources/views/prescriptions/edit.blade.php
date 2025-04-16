<!-- filepath: /home/d/coder/pharmacy/resources/views/prescriptions/edit.blade.php -->
<x-dashboardLayout :title="'Edit Prescription'" :breadcrumb="['Prescriptions' => route('prescriptions.index'), 'Edit' => null]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Prescription</h1>

        <form action="{{ route('prescriptions.update', $prescription->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf
            @method('PUT')

        

            <!-- Medical Notes -->
            <div>
                <label for="medical_notes" class="block text-sm font-medium text-gray-700 mb-1">Medical Notes</label>
                <textarea id="medical_notes" name="medical_notes" rows="4"
                          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('medical_notes') border-red-500 @enderror">{{ old('medical_notes', $prescription->medical_notes) }}</textarea>
                @error('medical_notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Images -->
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" id="images" name="images[]" multiple
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('image') border-red-500 @enderror">
                @if ($prescription->image)
                    <div class="mt-2 grid grid-cols-3 gap-4">
                        <div>
                            <img src="{{ asset('storage/' .$prescription->image) }}" alt="Prescription Image" class="w-24 h-24 object-cover rounded">
                        </div>
                    </div>
                @endif
                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('prescriptions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Update Prescription
                </button>
            </div>
        </form>
    </div>
</x-dashboardLayout>