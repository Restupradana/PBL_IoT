<div 
    x-data="{ open: localStorage.getItem('sidebar') === 'open' || window.innerWidth >= 1024 }"
    x-init="() => { $watch('open', val => localStorage.setItem('sidebar', val ? 'open' : 'closed')) }"
    class="min-h-screen bg-sky-600 text-white transition-all duration-300 z-20"
    :class="open ? 'w-64' : 'w-16'"
>
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between px-4 py-3 bg-sky-500 h-16">
          <!-- Logo -->
          <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                        <span class="ml-2 text-lg font-semibold text-white hidden md:block">Smart Trash</span>
                    </a>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <div class="mt-5 px-2">
        <!-- Dashboard -->
        <a 
            href="{{ route('dashboard') }}" 
            class="flex items-center py-2 px-4 rounded-md text-white {{ request()->routeIs('dashboard') ? 'bg-[#5680B0]' : 'hover:bg-[#5680B0]' }} mb-1"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="ml-3 whitespace-nowrap" x-show="open" x-transition>Dashboard</span>
        </a>

        <a 
            href="{{ route('locations.index') }}" 
            class="flex items-center py-2 px-4 rounded-md text-white {{ request()->routeIs('locations.*') ? 'bg-[#5680B0]' : 'hover:bg-[#5680B0]' }} mb-1"
        >
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
            </svg>
            <span class="ml-3 whitespace-nowrap" x-show="open" x-transition>Location</span>
        </a>

        <a 
            href="{{ route('history.index') }}" 
            class="flex items-center py-2 px-4 rounded-md text-white {{ request()->routeIs('history.*') ? 'bg-[#5680B0]' : 'hover:bg-[#5680B0]' }} mb-1"
        >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span class="ml-3 whitespace-nowrap" x-show="open" x-transition>History</span>
        </a>

        <a 
            href="{{ route('status.index') }}" 
            class="flex items-center py-2 px-4 rounded-md text-white {{ request()->routeIs('status.*') ? 'bg-[#5680B0]' : 'hover:bg-[#5680B0]' }} mb-1"
        >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
            </svg>
            <span class="ml-3 whitespace-nowrap" x-show="open" x-transition>Status</span>
        </a>

        <!-- Notifications -->
        <a 
            href="{{ route('notifications.index') }}" 
            class="flex items-center py-2 px-4 rounded-md text-white {{ request()->routeIs('notifications.*') ? 'bg-[#5680B0]' : 'hover:bg-[#5680B0]' }} mb-1"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="ml-3 whitespace-nowrap" x-show="open" x-transition>Notifikasi</span>
            @if(auth()->check() && \App\Models\Notifikasi::where('status_baca', false)->count() > 0)
                <span class="ml-auto bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs" x-show="open">
                    {{ \App\Models\Notifikasi::where('status_baca', false)->count() }}
                </span>
            @endif
        </a>

        <!-- Users (Admin Only) -->
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a 
                href="{{ route('users.index') }}" 
                class="flex items-center py-2 px-4 rounded-md text-white {{ request()->routeIs('users.*') ? 'bg-[#5680B0]' : 'hover:bg-[#5680B0]' }} mb-1"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="ml-3 whitespace-nowrap" x-show="open" x-transition>Pengguna</span>
            </a>
        @endif
    </div>
</div>