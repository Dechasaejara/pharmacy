<div class="image-upload">
    <label for="{{ $id }}"
        class="block text-lg font-medium text-gray-200 mb-4 text-center">{{ $label }}</label>
    <div class="flex flex-col items-center space-y-6">
        <!-- Form with File Input and Buttons -->
        <form id="{{ $id }}-form" action="{{ route('prescriptions.store') }}" method="POST"
            enctype="multipart/form-data" class="flex flex-col items-center space-y-4 w-full">
            @csrf
            <div class="w-full">
                <label for="medical_notes" class="block text-sm font-medium text-gray-100 mb-1">Medical Notes</label>
                <textarea id="medical_notes" name="medical_notes" rows="6"
                    class="w-full border bg-gray-100 rounded-md px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('medical_notes') border-red-500 @enderror">{{ old('medical_notes') }}</textarea>
                @error('medical_notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Image Preview -->
            <div class="w-full h-64 bg-gray-100 border border-gray-300 rounded-lg overflow-hidden shadow-lg">
                <img id="{{ $id }}-preview" src="{{ $value ?? 'https://via.placeholder.com/300' }}"
                    alt="Preview" class="w-full h-full object-contain">
            </div>
            <div id="{{ $id }}-button-container" class="flex flex-col items-center space-y-2">
                <label for="{{ $id }}" id="{{ $id }}-choose-label"
                    class="cursor-pointer bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-all flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Choose Image
                </label>
                <input type="file" id="{{ $id }}" name="{{ $name }}" accept="image/*"
                    class="hidden" onchange="handleImageSelection(event, '{{ $id }}')" />
                <button type="submit" id="{{ $id }}-upload-button"
                    class="hidden bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-all flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                    Upload
                </button>
                <p class="mt-2 text-sm text-gray-500">Supported formats: JPG, PNG, GIF. Max size: 2MB.</p>
            </div>
        </form>
    </div>
</div>
<script>
    /**
     * Handle image selection: preview the image and replace the Choose button with Upload.
     * @param {Event} event - The file input change event.
     * @param {string} id - The ID of the input element.
     */
    function handleImageSelection(event, id) {
        const file = event.target.files[0];
        if (file) {
            // Preview the image
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(`${id}-preview`).src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Replace Choose button with Upload button
            const chooseLabel = document.getElementById(`${id}-choose-label`);
            const uploadButton = document.getElementById(`${id}-upload-button`);
            chooseLabel.classList.add('hidden');
            uploadButton.classList.remove('hidden');
        }
    }
</script>
