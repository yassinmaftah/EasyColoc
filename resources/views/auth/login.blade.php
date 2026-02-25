<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="px-2 py-4">
        <h2 class="text-3xl font-bold text-gray-900">Sign in</h2>
        <p class="text-gray-400 mt-1 mb-10 text-sm">Sign in to continue</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mb-6">
                <label for="email" class="block text-sm font-bold text-gray-900 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="block w-full border-0 border-b-2 border-gray-200 focus:border-[#0d2a63] focus:ring-0 px-0 py-2 text-gray-900 placeholder-gray-300 bg-transparent transition-colors"
                    placeholder="email@example.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-8 relative">
                <label for="password" class="block text-sm font-bold text-gray-900 mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full border-0 border-b-2 border-gray-200 focus:border-[#0d2a63] focus:ring-0 px-0 py-2 text-gray-900 placeholder-gray-300 bg-transparent pr-10 transition-colors"
                    placeholder="********">

                <div class="absolute right-0 bottom-2 text-gray-300 cursor-pointer hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

            <div class="mt-10">
                <button type="submit" class="w-full bg-[#0d2a63] hover:bg-blue-900 text-white font-semibold py-3.5 rounded-full shadow-[0_10px_20px_rgba(13,42,99,0.25)] transition duration-200">
                    Login
                </button>
            </div>

            <div class="mt-8 text-center text-sm text-gray-400">
                Don't have an account? <a href="{{ route('register') }}" class="font-bold text-[#0d2a63] hover:underline">Sign up</a>
            </div>
        </form>
    </div>
</x-guest-layout>
