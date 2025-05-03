<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-100 mb-4">
                    {{ __("Profile Information") }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-800 dark:text-gray-200">
                    <div>
                        <span class="font-medium">Name:</span>
                        <div class="mt-1">{{ Auth::user()->name }}</div>
                    </div>
                    <div>
                        <span class="font-medium">Email:</span>
                        <div class="mt-1">{{ Auth::user()->email }}</div>
                    </div>
                    <div>
                        <span class="font-medium">Registered At:</span>
                        <div class="mt-1">{{ Auth::user()->created_at->format('d M Y') }}</div>
                    </div>
                    <div>
                        <span class="font-medium">Last Updated:</span>
                        <div class="mt-1">{{ Auth::user()->updated_at->diffForHumans() }}</div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('profile.edit') }}"
                       class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
