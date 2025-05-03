<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janitor Dashboard</title>
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
            <i class="bi bi-person-circle fs-4 dropdown-toggle" id="janitorDropdown" data-bs-toggle="dropdown" style="cursor: pointer;"></i>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="janitorDropdown">
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
            <li><a href="{{ route('janitor.dashboard') }}" class="text-white d-block py-2"><i class="bi bi-house"></i> Dashboard</a></li>
            <li><a href="{{ route('janitor.status') }}" class="text-white d-block py-2"><i class="bi bi-bar-chart"></i> Status</a></li>
            <li><a href="{{ route('janitor.location') }}" class="text-white d-block py-2"><i class="bi bi-geo-alt-fill"></i> Location</a></li>
            <li><a href="{{ route('janitor.history') }}" class="text-white d-block py-2"><i class="bi bi-clock-history"></i> History</a></li>
        </ul>

        <!-- User Section -->
        <a href="}" class="d-flex align-items-center p-2 text-dark text-decoration-none" 
           style="position: absolute; bottom: 10px; left: 10px; right: 10px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div class="bg-white d-flex justify-content-center align-items-center" 
                 style="width: 40px; height: 40px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <i class="bi bi-people-fill fs-4 text-dark"></i>
            </div>
            <span class="ms-2">Janitor</span>
        </a>
    </div>


<style>
        
        .sidebar a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px 0;
        }
        .sidebar a:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
            padding: 10px;
        }
        td {
            padding: 10px;
            text-align: center;
        }
        .print-button {
            margin-top: 10px;
            text-align: right;
        }
    </style>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Histori Pembuangan Sampah</h1>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tempat Sampah</th>
                        <th>Nama Petugas Sampah</th>
                        <th>Kategori</th>
                        <th>Berat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data -->
                    <tr>
                        <td>1</td>
                        <td>Taman Kota</td>
                        <td>Petugas A</td>
                        <td>Organik</td>
                        <td>12 kg</td>
                        <td>Selesai</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Area Mall</td>
                        <td>Petugas B</td>
                        <td>Plastik</td>
                        <td>8 kg</td>
                        <td>Pending</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Print Button -->
        <div class="print-button">
            <button class="btn btn-primary"><i class="bi bi-printer"></i> Print data</button>
        </div>
    </div>
</body>
</html>