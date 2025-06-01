<x-app-layout>
        <div class="max-w-[85dvw] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold">Lokasi Tempat Sampah</h1>
                    </div>

                    <!-- Map Container with custom styling -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="h-[600px]" id="mapContainer">
                            <x-maps-leaflet 
                                :markers="$locations"
                                :centerPoint="[1.0892744, 103.9867409]"
                                :zoomLevel="12"
                                :maxZoomLevel="18"
                                style="height: 100%;"
                            ></x-maps-leaflet>
                        </div>
                    </div>

                    <!-- DataTable with enhanced styling -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden p-4">
                        {{ $dataTable->table(['class' => 'min-w-full divide-y dark:divide-gray-200']) }}
                    </div>
                </div>
            </div>
        </div>

    @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = window.LaravelDataTables['lokasitempatsampah-table'];
            const locations = @json($locations);
            
            // Update status counts
            function updateStatusCounts() {
                let normalCount = 0;
                let penuhCount = 0;
                let beratBerlebihCount = 0;
                let offlineCount = 0;
                
                locations.forEach(location => {
                    const status = location.info.match(/Status: ([^<]+)/)[1];
                    if (status === 'Normal') normalCount++;
                    else if (status === 'Penuh') penuhCount++;
                    else if (status === 'Berat Berlebih') beratBerlebihCount++;
                    else if (status === 'Offline') offlineCount++;
                });
                
                document.getElementById('normalCount').textContent = normalCount;
                document.getElementById('penuhCount').textContent = penuhCount;
                document.getElementById('beratBerlebihCount').textContent = beratBerlebihCount;
                document.getElementById('offlineCount').textContent = offlineCount;
            }
            
            // Initialize counts
            updateStatusCounts();
            
            // Filter map markers based on status
            document.getElementById('filterStatus').addEventListener('change', function() {
                const status = this.value;
                
                // Get the Leaflet map instance
                const mapId = document.querySelector('[id^="leaflet-map-"]').id;
                const map = window.mymap; // This is the map instance from the Leaflet component
                
                // Clear existing markers
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });
                
                // Add filtered markers
                locations.forEach(location => {
                    const locationStatus = location.info.match(/Status: ([^<]+)/)[1];
                    
                    if (status === 'all' || status === locationStatus) {
                        // Create marker with custom icon based on status
                        let iconUrl = '/images/marker-green.png'; // Default
                        
                        if (locationStatus === 'Penuh') {
                            iconUrl = '/images/marker-yellow.png';
                        } else if (locationStatus === 'Berat Berlebih') {
                            iconUrl = '/images/marker-red.png';
                        } else if (locationStatus === 'Offline') {
                            iconUrl = '/images/marker-gray.png';
                        }
                        
                        // Create icon
                        const icon = L.icon({
                            iconUrl: iconUrl,
                            iconSize: [32, 32],
                            iconAnchor: [16, 32],
                            popupAnchor: [0, -32]
                        });
                        
                        // Add marker
                        const marker = L.marker([location.lat, location.long], {icon: icon});
                        marker.addTo(map);
                        marker.bindPopup(location.info);
                    }
                });
                
                // Also filter the datatable
                table.column(4).search(status === 'all' ? '' : status).draw();
            });
            
            // Refresh button
            document.getElementById('refreshMap').addEventListener('click', function() {
                // Show loading indicator
                this.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Loading...';
                
                // Fetch fresh data
                fetch('/api/tempat-sampah/locations')
                    .then(response => response.json())
                    .then(data => {
                        // Update locations
                        window.locations = data;
                        
                        // Reload the page to refresh the map with new data
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        this.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Refresh';
                    });
            });
            
            // Make the table rows clickable to show location on map
            document.querySelector('table').addEventListener('click', function(e) {
                const row = e.target.closest('tr');
                if (!row) return;
                
                const id = row.querySelector('td:first-child').textContent;
                const location = locations.find(loc => loc.info.includes(`ID: ${id}`));
                
                if (location) {
                    // Get the map instance
                    const map = window.mymap;
                    
                    // Center map on location
                    map.setView([location.lat, location.long], 16);
                    
                    // Find and open the popup for this marker
                    map.eachLayer(function(layer) {
                        if (layer instanceof L.Marker) {
                            const popupContent = layer.getPopup()?.getContent();
                            if (popupContent && popupContent.includes(`ID: ${id}`)) {
                                layer.openPopup();
                            }
                        }
                    });
                    
                    // Highlight the row
                    document.querySelectorAll('tr.bg-blue-50').forEach(tr => {
                        tr.classList.remove('bg-blue-50');
                    });
                    row.classList.add('bg-blue-50');
                }
            });
        });
    </script>
    @endpush
</x-app-layout>