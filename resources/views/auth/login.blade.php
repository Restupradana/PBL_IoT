@section('title', 'Login')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-8 space-y-6 max-w-md mx-auto mt-10">
        @csrf

        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white text-center">{{ __('Masuk ke Akun Anda') }}</h2>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Please Insert Your Mail" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="current-password"  placeholder="Please Insert Your Correctly Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:underline dark:text-indigo-400" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div>
            <x-primary-button class="w-full justify-center py-2 text-lg rounded-xl">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Belum punya akun?') }}
            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                {{ __('Daftar Sekarang') }}
            </a>
        </div>
    </form>
</x-guest-layout>
