<x-app-layout>
        <div class="max-w-[85dvw] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                 <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 px-4 pt-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Notifikasi') }}
                    </h2>
                    <div class="flex space-x-2">
                        <form action="{{ route('notifications.mark-all-as-read') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Tandai Semua Dibaca') }}
                            </button>
                        </form>
                    </div>
                </div>

                <div class="p-4 sm:p-6 text-gray-800">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-md flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="flex items-start p-4 rounded-lg transition-all duration-200 {{ $notification->read ? 'bg-gray-50' : 'bg-blue-50 border-l-4 border-blue-500' }} hover:shadow-md">
                                    <div class="flex-shrink-0 p-2 rounded-full {{ $notification->type === 'capacity_alert' ? 'bg-blue-100 text-blue-500' : 'bg-red-100 text-red-500' }}">
                                        @if($notification->type === 'capacity_alert')
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex flex-col sm:flex-row justify-between sm:items-start">
                                            <p class="text-sm font-medium {{ $notification->read ? 'text-gray-700' : 'text-blue-800' }}">
                                                {{ $notification->message }} ({{ $notification->jenis_notifikasi }})
                                            </p>
                                            <div class="flex space-x-2 mt-2 sm:mt-0 sm:ml-2">
                                                @if(!$notification->read)
                                                    <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center px-2 py-1 bg-blue-100 border border-transparent rounded-md font-medium text-xs text-blue-700 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            Tandai Dibaca
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-100 border border-transparent rounded-md font-medium text-xs text-red-700 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex flex-wrap items-center text-sm text-gray-600">
                                            <a href="#" class="flex items-center hover:underline mr-2 mb-1 sm:mb-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                {{ $notification->tempatSampah->nama }} ({{ $notification->tempatSampah->alamat_deskripsi }})
                                            </a>
                                            <span class="hidden sm:inline mx-1">•</span>
                                            <span class="flex items-center mb-1 sm:mb-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $notification->waktu_notifikasi->diffForHumans() ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada notifikasi</h3>
                            <p class="mt-2 text-sm text-gray-600">
                                Anda tidak memiliki notifikasi saat ini.
                            </p>
                            <a href="{{ route('dashboard') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
</x-app-layout>