@props(['imageUrl' => $image])

<div id="imageModal" class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-75">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-4xl mx-auto relative">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-semibold">Prescription Image</h3>
                <button class="modal-close text-3xl">&times;</button>
            </div>
            <div class="p-4">
                <img id="modalImage" src="{{ $imageUrl }}" alt="Full size prescription image" 
                     class="max-h-[80vh] w-full object-contain">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('imageModal');
        
        // Open modal on image click
        document.body.addEventListener('click', function(e) {
            const trigger = e.target.closest('.image-modal-trigger');
            if (trigger) {
                e.preventDefault();
                const img = trigger.querySelector('img');
                document.getElementById('modalImage').src = img.src;
                modal.classList.remove('hidden');
            }
        });

        // Close modal handlers
        document.querySelectorAll('.modal-close').forEach(btn => {
            btn.addEventListener('click', () => modal.classList.add('hidden'));
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });
    });
</script>
@endpush