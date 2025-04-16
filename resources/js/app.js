// import "./bootstrap";

// document.addEventListener("DOMContentLoaded", function () {
//     // Initialize mobile menu
//     initializeMobileMenu();

//     // Initialize map if the map element exists
//     const mapElement = document.getElementById("map");
//     if (mapElement) {
//         try {
//             initializeMap(mapElement);
//         } catch (error) {
//             console.error("Error initializing the map:", error);
//         }
//     }
// });

// /**
//  * Initializes the mobile menu functionality.
//  */
// function initializeMobileMenu() {
//     const mobileMenuButton = document.querySelector(
//         "[data-mobile-menu-button]"
//     );
//     const mobileMenu = document.querySelector("[data-mobile-menu]");
//     const mobileMenuOverlay = document.querySelector(
//         "[data-mobile-menu-overlay]"
//     );

//     if (mobileMenuButton && mobileMenu && mobileMenuOverlay) {
//         mobileMenuButton.addEventListener("click", () => {
//             const isOpen = mobileMenu.style.display === "block";
//             mobileMenu.style.display = isOpen ? "none" : "block";
//             mobileMenuOverlay.style.display = isOpen ? "none" : "block";
//         });

//         mobileMenuOverlay.addEventListener("click", () => {
//             mobileMenu.style.display = "none";
//             mobileMenuOverlay.style.display = "none";
//         });
//     }
// }

// /**
//  * Initializes the map using Leaflet.js.
//  * @param {HTMLElement} mapElement - The map container element.
//  */
// function initializeMap(mapElement) {
//     // Default location (New York City)
//     const defaultLat = 40.7128;
//     const defaultLng = -74.006;

//     // Initialize the map
//     const map = L.map(mapElement).setView([defaultLat, defaultLng], 13);

//     // Add OpenStreetMap tiles
//     L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
//         maxZoom: 19,
//         attribution:
//             '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
//     }).addTo(map);

//     // Parse pharmacy data from the data attribute
//     const pharmacies = parsePharmacyData(mapElement);

//     // Add markers for each pharmacy
//     addPharmacyMarkers(map, pharmacies);

//     // Adjust the map to fit all markers
//     fitMapToBounds(map, pharmacies);
// }

// /**
//  * Parses pharmacy data from the map element's data attribute.
//  * @param {HTMLElement} mapElement - The map container element.
//  * @returns {Array} An array of pharmacy objects.
//  */
// function parsePharmacyData(mapElement) {
//     try {
//         const data = mapElement.getAttribute("data-pharmacies");
//         console.log("data", data);
//         return JSON.parse(data) || [];
//     } catch (error) {
//         console.error("Error parsing pharmacy data:", error);
//         return [];
//     }
// }

// /**
//  * Adds markers for each pharmacy to the map.
//  * @param {Object} map - The Leaflet map instance.
//  * @param {Array} pharmacies - An array of pharmacy objects.
//  */
// function addPharmacyMarkers(map, pharmacies) {
//     pharmacies.forEach((pharmacy) => {
//         if (pharmacy.latitude && pharmacy.longitude) {
//             const marker = L.marker([
//                 pharmacy.latitude,
//                 pharmacy.longitude,
//             ]).addTo(map);
//             marker.bindPopup(`
//                 <div>
//                     <h3 class="font-bold">${pharmacy.name}</h3>
//                     <p>${pharmacy.location}</p>
//                     <p><strong>Phone:</strong> ${pharmacy.phone}</p>
//                     <p><strong>Email:</strong> ${pharmacy.email}</p>
//                 </div>
//             `);
//         }
//     });
// }

// /**
//  * Adjusts the map view to fit all pharmacy markers.
//  * @param {Object} map - The Leaflet map instance.
//  * @param {Array} pharmacies - An array of pharmacy objects.
//  */
// function fitMapToBounds(map, pharmacies) {
//     const bounds = pharmacies
//         .filter((pharmacy) => pharmacy.latitude && pharmacy.longitude)
//         .map((pharmacy) => [pharmacy.latitude, pharmacy.longitude]);

//     if (bounds.length > 0) {
//         map.fitBounds(bounds);
//     }
// }


import "./bootstrap";
import Swal from 'sweetalert2';
window.Swal = Swal;
document.addEventListener("DOMContentLoaded", function () {
    initializeMobileMenu();
    initializeMapIfExists();
});

function initializeMobileMenu() {
    // ... (existing mobile menu code remains unchanged) ...
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
        maxZoom: 29,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    const quotations = parseQuotationData(mapElement);
    addQuotationMarkers(map, quotations);
    fitMapToQuotationBounds(map, quotations);
}

function parseQuotationData(mapElement) {
    try {
        const data = mapElement.getAttribute("data-quotations");
        console.log('Raw JSON data:', data); 
        const parsed = JSON.parse(data) || [];
        // Ensure we always return an array
        return Array.isArray(parsed) ? parsed : [];
    } catch (error) {
        console.error("Error parsing quotation data:", error);
        return [];
    }
}

function addQuotationMarkers(map, quotations) {
    quotations.forEach(quotation => {
        if (quotation.pharmacy?.latitude && quotation.pharmacy?.longitude) {
            const marker = L.marker([
                quotation.pharmacy.latitude,
                quotation.pharmacy.longitude
            ]).addTo(map);

            marker.bindPopup(`
                <div class="p-2">
                    <h3 class="font-bold text-lg">${quotation.pharmacy.name}</h3>
                    <p class="text-sm text-gray-600">${quotation.pharmacy.location}</p>
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
        .filter(q => q.pharmacy?.latitude && q.pharmacy?.longitude)
        .map(q => [q.pharmacy.latitude, q.pharmacy.longitude]);

    if (bounds.length > 0) {
        map.fitBounds(bounds);
    }
}