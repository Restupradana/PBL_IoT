<x-app-layout>
        <div class="max-w-[85dvw] mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- User Information Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Informasi Pengguna</h3>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->name }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->email }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Peran</dt>
                                <dd class="mt-1">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        @if($user->role == 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                        @elseif($user->role == 'janitor') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                        @elseif($user->role == 'user') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Dibuat</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('d M Y, h:i A') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- User Reports -->
        </div>
</x-app-layout>