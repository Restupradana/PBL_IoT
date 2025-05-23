@php
    $role = auth()->user()->role ?? '';
@endphp

<div class="text-white p-3 d-flex flex-column" style="width: 250px; min-height: 100vh; background-color: #4682B4;">
    <ul class="list-unstyled flex-grow-1">
        @if ($role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="text-white d-block py-2"><i class="bi bi-house"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.status') }}" class="text-white d-block py-2"><i class="bi bi-bar-chart"></i> Status</a></li>
            <li><a href="{{ route('admin.location') }}" class="text-white d-block py-2"><i class="bi bi-geo-alt-fill"></i> Location</a></li>
            <li><a href="{{ route('admin.history') }}" class="text-white d-block py-2"><i class="bi bi-clock-history"></i> History</a></li>
        @elseif ($role === 'user')
            <li><a href="{{ route('user.dashboard') }}" class="text-white d-block py-2"><i class="bi bi-house"></i> Dashboard</a></li>
            <li><a href="{{ route('user.status') }}" class="text-white d-block py-2"><i class="bi bi-bar-chart"></i> Status</a></li>
            <li><a href="{{ route('user.location') }}" class="text-white d-block py-2"><i class="bi bi-geo-alt-fill"></i> Location</a></li>
            <li><a href="{{ route('user.history') }}" class="text-white d-block py-2"><i class="bi bi-clock-history"></i> History</a></li>
        @elseif ($role === 'petugas')
            <li><a href="{{ route('janitor.dashboard') }}" class="text-white d-block py-2"><i class="bi bi-house"></i> Dashboard</a></li>
            <li><a href="{{ route('janitor.status') }}" class="text-white d-block py-2"><i class="bi bi-bar-chart"></i> Status</a></li>
            <li><a href="{{ route('janitor.location') }}" class="text-white d-block py-2"><i class="bi bi-geo-alt-fill"></i> Location</a></li>
            <li><a href="{{ route('janitor.history') }}" class="text-white d-block py-2"><i class="bi bi-clock-history"></i> History</a></li>
        @else
            <li><span class="text-white">Role tidak dikenali</span></li>
        @endif
    </ul>
</div>
