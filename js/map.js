 // Initialize the map
 var map = L.map('map', {
    scrollWheelZoom: false, // Disable scroll wheel zoom 
    dragging: false, // Disable map panning 
    zoomControl: false, // Disable zoom controls 
    attributionControl: false // Disable attribution controls
}).setView([47.8095, 13.0550], 13); // Center the map on Salzburg, Austria

// Add OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    zIndex:0
}).addTo(map);

// Invalidate map size to ensure proper loading 
function resizeMap() { 
    map.invalidateSize(); 
} 
// Invalidate map size on load and resize 
window.addEventListener('load', resizeMap); 
window.addEventListener('resize', resizeMap);

// Move the map upwards 
function moveMapUp() { 
    document.getElementById('map').style.transform = 'translateY(-100px)'; // Adjust the value to move the map upwards 
}

map.on('load', function() { 
    setTimeout(moveMapUp, 200); // Adjust the delay as needed 
});

