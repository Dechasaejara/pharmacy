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
    const defaultLat = 9.7128;
    const defaultLng = 38.006;
    const map = L.map(mapElement).setView([defaultLat, defaultLng], 13);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    const quotations = parseQuotationData(mapElement);
    addQuotationMarkers(map, quotations);
    fitMapToQuotationBounds(map, quotations);
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