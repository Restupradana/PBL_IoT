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
<a href="{{ route('user.edituser') }}"  class="d-flex align-items-center p-2 text-dark text-decoration-none" onclick="openProfileModal()"
   style="display: flex; align-items: center; gap: 10px; padding: 10px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

    <!-- Foto Profil -->
    <div class="bg-white d-flex justify-content-center align-items-center"
         style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden;">
        <img id="profileImage" src="default-profile.png" alt="User Profile"
             style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <span id="usernameDisplay">User</span>
</a>
    </div>

        
<!-- Main Content -->
<div class="flex-grow-1 bg-light p-4">
            <h1 class="mb-4">Dashboard || User</h1>
            <h2>Total Rubbish</h2>
            <div class="d-flex align-items-center justify-content-between mt-4">
                <!-- Progress Circle -->
                <div class="progress-circle text-center">
                    <div class="circle">
                        <span class="percentage">75%</span>
                    </div>
                </div>

        
         <!-- Waste Types -->
         <div class="flex-container">
    <h2 class="flex-item">The total of every waste</h2>
    <div class="waste-types flex-item">
        <p>Organic waste: 50%</p>
        <p>Plastic/glass bottle waste: 50%</p>
        <p>Metal: 50%</p>
    </div>
</div>

   
                <script>
    function fetchRubbishStatus() {
        $.ajax({
            url: '/api/rubbish-status', // Endpoint API
            method: 'GET',
            success: function (data) {
                // Perbarui progress circle
                $('.progress-circle').css(
                    'background', 
                    `conic-gradient(#007BFF ${data.total_rubbish}%, #e0e0e0 ${data.total_rubbish}%)`
                );
                $('.progress-circle .percentage').text(data.total_rubbish + '%');

                // Perbarui jenis sampah
                $('.waste-types').html(`
                    <p>Organic waste: ${data.organic}%</p>
                    <p>Plastic/glass bottle waste: ${data.plastic}%</p>
                    <p>Metal: ${data.metal}%</p>
                `);
            },
            error: function () {
                console.error('Failed to fetch rubbish status');
            }
        });
    }

    // Panggil fungsi setiap 5 detik untuk pembaruan real-time
    setInterval(fetchRubbishStatus, 5000);

    // Load pertama kali
    fetchRubbishStatus();
</script>                

</body>
</html>