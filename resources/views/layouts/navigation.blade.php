<nav x-data="{ open: false }" class="bg-[#458EF7] top-0 w-full z-10 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-end h-16 pr-2">

            <!-- Notifications -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 justify-end">
                <div class="relative mr-4" x-data="{ open: false }">
                    <button 
                        @click="open = !open" 
                        class="flex items-center text-sm font-medium text-white hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out p-2 rounded-full hover:bg-gray-100"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if(auth()->check() && \App\Models\Notifikasi::where('status_baca', false)->count() > 0)
                            <span class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs absolute -top-1 -right-1">
                                {{ \App\Models\Notifikasi::where('status_baca', false)->count() }}
                            </span>
                        @endif
                    </button>

                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                        style="display: none;"
                    >
                        <div class="py-1 max-h-80 overflow-y-auto">
                            <div class="px-4 py-3 border-b">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-sm font-medium text-gray-700">Notifikasi</h3>
                                    <a href="{{ route('notifications.index') }}" class="text-xs text-blue-500 hover:text-blue-700">Lihat Semua</a>
                                </div>
                            </div>
                            
                            @if(auth()->check())
                                @php
                                    $notifications = \App\Models\Notifikasi::with('tempatSampah')
                                        ->orderBy('created_at', 'desc')
                                        ->take(5)
                                        ->get();
                                @endphp
                                
                                @if($notifications->count() > 0)
                                    @foreach($notifications as $notification)
                                        <a href="{{ route('notifications.mark-as-read', $notification->id) }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 {{ $notification->read ? 'opacity-75' : 'border-l-4 border-blue-500' }}">
                                            <div class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $notification->read ? 'text-gray-400' : 'text-blue-500' }} mr-3 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium">
                                                        {{ $notification->message }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="px-4 py-3 text-sm text-gray-500 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        Tidak ada notifikasi.
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out rounded-full p-2">
                            <div class="mr-2">{{ Auth::user()->name ?? 'Guest' }}</div>
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">
                                {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'G' }}
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @auth
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('login')" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Log in') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                {{ __('Register') }}
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
    </div>

    <!-- Responsive Navigation Menu -->
</nav>