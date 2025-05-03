<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">

    <div class="text-white d-flex align-items-center justify-content-between px-4 py-3 shadow-sm" 
     style="background-color:rgb(55, 200, 233);"> <!-- Custom Blue -->

    <!-- Left Section: Icon + Text -->
    <div class="d-flex align-items-center">
        <i class="bi bi-trash-fill fs-3 me-3"></i> <!-- Ikon tempat sampah -->
        <h4 class="mb-0">Smart Trash Bin</h4>
    </div>

    <!-- Right Section: Notification + User Icon -->
    <div class="d-flex align-items-center">
    <div class="header-blue d-flex align-items-center justify-content-between px-4 py-3 shadow-sm">
</div>

        <!-- Bell Dropdown -->
        <div class="dropdown">
            <i class="bi bi-bell fs-4 mx-3 dropdown-toggle" id="notificationDropdown" data-bs-toggle="dropdown" style="cursor: pointer;"></i>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                <li><a class="dropdown-item" href="#">Notification 1</a></li>
                <li><a class="dropdown-item" href="#">Notification 2</a></li>
                <li><a class="dropdown-item" href="#">View All Notifications</a></li>
            </ul>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <i class="bi bi-person-circle fs-4 dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" style="cursor: pointer;"></i>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
    /* styles.css */
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.sidebar {
    height: 100vh;
}

.sidebar ul li a:hover {
    text-decoration: underline;
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

.progress-circle .circle {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100px;
    height: 100px;
    background-color: #fff;
    border-radius: 50%;
}

.progress-circle .percentage {
    font-weight: bold;
}

.waste-types {
    font-size: 18px;
}

.waste-types p {
    margin: 10px 0;
}
    </style>


</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="text-white p-3 d-flex flex-column" style="width: 250px; min-height: 100vh; background-color: #4682B4; position: relative;">
        <!-- Sidebar Content -->
        <ul class="list-unstyled flex-grow-1">
            <li><a href="{{ route('user.dashboard') }}" class="text-white d-block py-2"><i class="bi bi-house"></i> Dashboard</a></li>
            <li><a href="{{ route('user.status') }}" class="text-white d-block py-2"><i class="bi bi-bar-chart"></i> Status</a></li>
            <li><a href="{{ route('user.location') }}" class="text-white d-block py-2"><i class="bi bi-geo-alt-fill"></i> Location</a></li>
            <li><a href="{{ route('user.history') }}" class="text-white d-block py-2"><i class="bi bi-clock-history"></i> History</a></li>
        </ul>

        <!-- User Section -->
        <a href="}" class="d-flex align-items-center p-2 text-dark text-decoration-none" 
           style="position: absolute; bottom: 10px; left: 10px; right: 10px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div class="bg-white d-flex justify-content-center align-items-center" 
                 style="width: 40px; height: 40px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <i class="bi bi-people-fill fs-4 text-dark"></i>
            </div>
            <span class="ms-2">User</span>
        </a>
    </div>

<style>
.progress-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px;
}

.progress-circle {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    position: relative;
}

.progress-circle .circle {
    width: 100px;
    height: 100px;
    background-color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.status-detail {
    text-align: center;
    margin-top: 10px;
    font-size: 18px;
}

.organic {
    background: conic-gradient(#4CAF50 85%, #e0e0e0 85%);
}

.plastic {
    background: conic-gradient(#FFC107 60%, #e0e0e0 60%);
}

.metal {
    background: conic-gradient(#F44336 40%, #e0e0e0 40%);
}
</style>

<div class="container mt-4">
    <h1 class="text-center mb-4">Status Tempat Sampah</h1>

    <div class="d-flex justify-content-around">
        <!-- Organik -->
        <div class="progress-container">
            <div class="progress-circle organic">
                <div class="circle">
                    <span class="percentage" id="organic-circle">85%</span>
                </div>
            </div>
            <div class="status-detail">
                <p>Kapasitas: <span id="organic-capacity">85%</span></p>
                <p>Berat: <span id="organic-weight">12 kg</span></p>
                <p>Waktu: <span id="organic-time">10:45 AM</span></p>
            </div>
        </div>

        <!-- Plastik -->
        <div class="progress-container">
            <div class="progress-circle plastic">
                <div class="circle">
                    <span class="percentage" id="plastic-circle">60%</span>
                </div>
            </div>
            <div class="status-detail">
                <p>Kapasitas: <span id="plastic-capacity">60%</span></p>
                <p>Berat: <span id="plastic-weight">8 kg</span></p>
                <p>Waktu: <span id="plastic-time">10:45 AM</span></p>
            </div>
        </div>

        <!-- Metal -->
        <div class="progress-container">
            <div class="progress-circle metal">
                <div class="circle">
                    <span class="percentage" id="metal-circle">40%</span>
                </div>
            </div>
            <div class="status-detail">
                <p>Kapasitas: <span id="metal-capacity">40%</span></p>
                <p>Berat: <span id="metal-weight">5 kg</span></p>
                <p>Kelembapan: <span id="metal-humidity">30%</span></p>
                <p>Waktu: <span id="metal-time">10:45 AM</span></p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchWasteStatus() {
        $.ajax({
            url: '/api/waste-status', // Endpoint API Laravel
            method: 'GET',
            success: function (data) {
                // Perbarui progress circle dan teks Organik
                $('.organic').css(
                    'background',
                    `conic-gradient(#4CAF50 ${data.organic.capacity}%, #e0e0e0 ${data.organic.capacity}%)`
                );
                $('#organic-circle').text(data.organic.capacity + '%');
                $('#organic-capacity').text(data.organic.capacity + '%');
                $('#organic-weight').text(data.organic.weight);
                $('#organic-time').text(data.organic.time);

                // Perbarui progress circle dan teks Plastik
                $('.plastic').css(
                    'background',
                    `conic-gradient(#FFC107 ${data.plastic.capacity}%, #e0e0e0 ${data.plastic.capacity}%)`
                );
                $('#plastic-circle').text(data.plastic.capacity + '%');
                $('#plastic-capacity').text(data.plastic.capacity + '%');
                $('#plastic-weight').text(data.plastic.weight);
                $('#plastic-time').text(data.plastic.time);

                // Perbarui progress circle dan teks Metal
                $('.metal').css(
                    'background',
                    `conic-gradient(#F44336 ${data.metal.capacity}%, #e0e0e0 ${data.metal.capacity}%)`
                );
                $('#metal-circle').text(data.metal.capacity + '%');
                $('#metal-capacity').text(data.metal.capacity + '%');
                $('#metal-weight').text(data.metal.weight);
                $('#metal-humidity').text(data.metal.humidity);
                $('#metal-time').text(data.metal.time);
            },
            error: function () {
                console.error('Gagal mengambil data status sampah.');
            }
        });
    }

    // Perbarui data setiap 5 detik
    setInterval(fetchWasteStatus, 5000);

    // Load pertama kali
    fetchWasteStatus();
</script>

</body>
</html>