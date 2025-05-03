<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janitor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> <!-- Tambahkan Leaflet CSS -->

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .map-container {
            height: 300px;
        }

        .sidebar {
            height: 100vh;
            background-color: #4682B4;
            width: 250px;
        }

        .progress-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: conic-gradient(#007BFF 75%, #e0e0e0 75%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #007BFF;
            position: relative;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="text-white p-3 d-flex flex-column sidebar">
        <ul class="list-unstyled flex-grow-1">
            <li><a href="{{ route('janitor.dashboard') }}" class="text-white d-block py-2"><i class="bi bi-house"></i> Dashboard</a></li>
            <li><a href="{{ route('janitor.status') }}" class="text-white d-block py-2"><i class="bi bi-bar-chart"></i> Status</a></li>
            <li><a href="{{ route('janitor.location') }}" class="text-white d-block py-2"><i class="bi bi-geo-alt-fill"></i> Location</a></li>
            <li><a href="{{ route('janitor.history') }}" class="text-white d-block py-2"><i class="bi bi-clock-history"></i> History</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="text-center bg-primary text-white p-3">
            <h2>Lokasi Tempat Sampah</h2>
        </div>

        <!-- Bagian Peta -->
        <div id="map" class="map-container mt-3"></div>

        <!-- Tabel Lokasi -->
        <div class="table-container mt-4">
            <h3>Daftar Lokasi</h3>
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Tempat</th>
                        <th>Sampah</th>
                        <th>Alamat</th>
                        <th>Koordinat</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Baris tabel akan diisi dengan data -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> <!-- Tambahkan Leaflet JS -->

<script>
    var map = L.map('map').setView([1.119, 104.049], 13); // Koordinat Batam
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var locations = [
    { lat: 1.125, lng: 104.057, place: "Nongsa", trashType: "Organik" },
    { lat: 1.138, lng: 104.028, place: "Batam Center", trashType: "Anorganik" },
    { lat: 1.145, lng: 104.026, place: "Jodoh", trashType: "Campuran" }
];

locations.forEach(loc => {
    L.marker([loc.lat, loc.lng]).addTo(map)
        .bindPopup(`<b>${loc.place}</b><br>Sampah: ${loc.trashType}`);
});
</script>

</body>
</html>