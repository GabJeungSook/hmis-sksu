@section('title', 'Map')
<div>
    <div id="map" style="height:390px"></div>
    <label for="radiusSlider">Radius: <span id="radiusValue">1000</span> meters</label>
    <input type="range" id="radiusSlider" min="10" max="10000" step="10" value="1000" style="width:100%;">
    {{-- {{$this->table}} --}}
</div>
<script>
    const map = L.map('map');

// Placeholder for circle
let circle;

// Function to update the circle on the map
function updateCircle(lat, lng, radius) {
    if (circle) {
        map.removeLayer(circle);  // Remove the old circle
    }
    circle = L.circle([lat, lng], {
        radius: radius,
        color: 'blue',
        fillColor: '#30c',
        fillOpacity: 0.2
    }).addTo(map);
}

// Check if Geolocation is available
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // Set map view to the user's location
            map.setView([lat, lng], 13);

            // Add a marker to the current location
            L.marker([lat, lng]).addTo(map)
                .bindPopup('You are here')
                .openPopup();

            // Set initial circle
            updateCircle(lat, lng, document.getElementById('radiusSlider').value);

            // Update radius when slider changes
            document.getElementById('radiusSlider').addEventListener('input', function () {
                const radius = this.value;
                document.getElementById('radiusValue').innerText = radius;
                updateCircle(lat, lng, radius);
            });
        },
        function (error) {
            console.error("Geolocation error: " + error.message);
            // Set default location if geolocation fails
            map.setView([51.505, -0.09], 13);
        }
    );
} else {
    console.log("Geolocation is not available");
    // Set default location if geolocation is not supported
    map.setView([51.505, -0.09], 13);
}

// Add OpenStreetMap tile layer
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
</script>

