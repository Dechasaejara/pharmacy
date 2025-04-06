<!-- filepath: /home/d/coder/pharmacy/resources/views/components/map.blade.php -->
<div id="map" class="w-full h-96 rounded-lg shadow-lg"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the map
        const map = L.map('map').setView([0, 0], 13); // Default view (latitude, longitude, zoom level)

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Get the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Set the map view to the user's location
                    map.setView([lat, lng], 13);

                    // Add a marker at the user's location
                    L.marker([lat, lng]).addTo(map)
                        .bindPopup('You are here!')
                        .openPopup();
                },
                function (error) {
                    console.error('Error getting location:', error);
                    alert('Unable to retrieve your location.');
                }
            );
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    });
</script>

<!-- Include Leaflet.js CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-o9N1j8RE6eN3Rz+8zU8yAuixm5pQYt1cU9yJ8A+0pAA=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-o9N1j8RE6eN3Rz+8zU8yAuixm5pQYt1cU9yJ8A+0pAA=" crossorigin=""></script>