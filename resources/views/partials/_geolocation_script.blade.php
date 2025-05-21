<script>
    document.addEventListener('DOMContentLoaded', function() {
        const latitudeField = document.getElementById('latitude');
        const longitudeField = document.getElementById('longitude');
        const countryField = document.getElementById('country');
        const stateField = document.getElementById('state');
        const cityField = document.getElementById('city');
        const addressField = document.getElementById('address'); // Assuming you have an address field with this ID
        const autoFillBtn = document.getElementById('autoFillBtn');
        const pictureInput = document.getElementById('picture');
        const picturePreview = document.getElementById('picturePreview'); // Ensure your img tag in the partial has this ID
    
        function fillGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        if(latitudeField) latitudeField.value = position.coords.latitude;
                        if(longitudeField) longitudeField.value = position.coords.longitude;
    
                        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`)
                            .then(response => response.json())
                            .then(data => {
                                const address = data.address || {};
                                if(countryField) countryField.value = address.country || '';
                                if(stateField) stateField.value = address.state || address.region || '';
                                if(cityField) cityField.value = address.city || address.town || address.village || '';
                                if(addressField) addressField.value = data.display_name || ''; // Or a more structured address
                            })
                            .catch(error => {
                                console.error('Error fetching location details:', error);
                                // alert('Unable to fetch location details. Please try again.');
                            });
                    },
                    function(error) {
                        console.warn('Geolocation error:', error.message);
                        // alert('Unable to retrieve location. Please check permissions or try again.');
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                console.warn('Geolocation is not supported by this browser.');
                // alert('Geolocation is not supported by your browser.');
            }
        }
    
        if (autoFillBtn) {
            autoFillBtn.addEventListener('click', fillGeolocation);
            
            // Auto-fill on page load only if creating a new profile (no existing lat/long)
            // Check if latitudeField exists and is empty (good indicator for new/assign forms)
            // The `profile` variable might not be defined in assign_role.blade.php context in the same way for this check
            // So, we check if the fields themselves are empty.
            if (latitudeField && !latitudeField.value && longitudeField && !longitudeField.value &&
                countryField && !countryField.value && stateField && !stateField.value &&
                cityField && !cityField.value && addressField && !addressField.value) {
                // fillGeolocation(); // Uncomment if you want auto-fill on load for empty forms
            }
        }
    
        if(pictureInput && picturePreview) {
            pictureInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        picturePreview.src = event.target.result;
                        picturePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                     // If no file is selected, or selection is cleared (though browsers usually don't allow clearing file input easily)
                     // you might want to hide preview or revert to a default.
                     // For now, if a picture existed (in edit mode), it remains. If not, preview stays hidden or shows new one.
                }
            });
        }
    });
    </script>