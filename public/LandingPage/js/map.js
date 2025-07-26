// Access the global variable defined in the Blade template
var latitude = window.storeLocation.latitude;
var longitude = window.storeLocation.longitude;
var nama = window.storeLocation.nama;

// Initialize the Leaflet map
var map = L.map('map').setView([latitude, longitude], 13);

// Add tile layer from OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Custom marker using Font Awesome
var customIcon = L.divIcon({
    className: 'custom-marker', // Custom marker class
    html: '<i class="fas fa-map-marker-alt"></i>', // Font Awesome marker icon
    iconSize: [30, 42], // Adjust size to fit well
    iconAnchor: [15, 42], // Anchor point so it points correctly
    popupAnchor: [0, -40] // Position popup relative to the icon
});

// Add a marker for the store location with a popup
L.marker([latitude, longitude], { icon: customIcon }).addTo(map)
    .bindPopup(`
            <div>${nama}</div>
        `)
    .openPopup();