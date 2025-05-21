import "./bootstrap";
import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener("DOMContentLoaded", function () {
    initializeMobileMenu();
    initializeMapIfExists();
});

function initializeMobileMenu() {
    const mobileMenuButton = document.querySelector("[data-mobile-menu-button]");
    const mobileMenu = document.querySelector("[data-mobile-menu]");
    const mobileMenuOverlay = document.querySelector("[data-mobile-menu-overlay]");

    if (mobileMenuButton && mobileMenu && mobileMenuOverlay) {
        mobileMenuButton.addEventListener("click", () => {
            const isOpen = mobileMenu.style.display === "block";
            mobileMenu.style.display = isOpen ? "none" : "block";
            mobileMenuOverlay.style.display = isOpen ? "none" : "block";
        });

        mobileMenuOverlay.addEventListener("click", () => {
            mobileMenu.style.display = "none";
            mobileMenuOverlay.style.display = "none";
        });
    }
}

function initializeMapIfExists() {
    const mapElement = document.getElementById("map");
    if (mapElement) {
        try {
            initializeQuotationMap(mapElement);
        } catch (error) {
            console.error("Error initializing the map:", error);
        }
    }
}

function initializeQuotationMap(mapElement) {
    const defaultLat = 8.9806; // Latitude for Addis Ababa
    const defaultLng = 38.7578; // Longitude for Addis Ababa
    const defaultZoom = 12; // City level zoom

    const map = L.map(mapElement);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    // Try to get current location
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                map.setView([lat, lng], defaultZoom); // Set view to current location
            },
            (error) => {
                console.warn("Geolocation failed, using default location:", error);
                map.setView([defaultLat, defaultLng], defaultZoom); // Fallback to default
                Swal.fire({
                    icon: 'warning',
                    title: 'Location Unavailable',
                    text: 'Could not retrieve your current location. Displaying map for Addis Ababa.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            },
            {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            }
        );
    } else {
        console.log("Geolocation is not supported by this browser, using default location.");
        map.setView([defaultLat, defaultLng], defaultZoom); // Fallback to default
        Swal.fire({
            icon: 'info',
            title: 'Geolocation Not Supported',
            text: 'Your browser does not support geolocation. Displaying map for Addis Ababa.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    }

    const quotations = parseQuotationData(mapElement);
    addQuotationMarkers(map, quotations);

    // Only fit bounds if there are quotations, otherwise the initial view from geolocation/default is used
    if (quotations.length > 0) {
        fitMapToQuotationBounds(map, quotations);
    }
}

function parseQuotationData(mapElement) {
    try {
        const data = mapElement.getAttribute("data-quotations");
        const parsed = JSON.parse(data) || [];
        console.log({ parsed });
        return Array.isArray(parsed) ? parsed : [];
    } catch (error) {
        console.error("Error parsing quotation data:", error);
        return [];
    }
}

function addQuotationMarkers(map, quotations) {
    quotations.forEach(quotation => {
        if (quotation.latitude && quotation.longitude) {
            const marker = L.marker([
                quotation.latitude,
                quotation.longitude
            ]).addTo(map);

            marker.bindPopup(`
                <div class="p-2">
                    <h3 class="font-bold text-lg">${quotation.pharmacy_name}</h3>
                    <div class="mt-2">
                        <p class="text-sm"><strong>Quotation Status:</strong> <span class="uppercase">${quotation.status}</span></p>
                        <p class="text-sm"><strong>Total Amount:</strong> $${quotation.total_amount}</p>
                        <p class="text-sm"><strong>Valid Until:</strong> ${quotation.valid_until || 'N/A'}</p>
                        <p class="text-sm"><strong>Notes:</strong> ${quotation.notes || 'None'}</p>
                    </div>
                </div>
            `);
        }
    });
}

function fitMapToQuotationBounds(map, quotations) {
    const bounds = quotations
        .filter(q => q.latitude && q.longitude)
        .map(q => [q.latitude, q.longitude]);

    if (bounds.length > 0) {
        map.fitBounds(bounds);
    }
}