<div class="text-white p-3 d-flex flex-column" style="width: 250px; min-height: 100vh; background-color: #4682B4;">
    <ul class="list-unstyled flex-grow-1">
        <li><a href="{{ route('user.dashboard') }}" class="text-white d-block py-2"><i class="bi bi-house"></i> Dashboard</a></li>
        <li><a href="{{ route('user.status') }}" class="text-white d-block py-2"><i class="bi bi-bar-chart"></i> Status</a></li>
        <li><a href="{{ route('user.location') }}" class="text-white d-block py-2"><i class="bi bi-geo-alt-fill"></i> Location</a></li>
        <li><a href="{{ route('user.history') }}" class="text-white d-block py-2"><i class="bi bi-clock-history"></i> History</a></li>
    </ul>
</div>