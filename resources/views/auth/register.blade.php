<x-guest-layout>
    <div class="px-2 py-4">
        <a href="{{ route('login') }}" class="inline-flex items-center text-gray-400 hover:text-gray-600 mb-8 text-sm font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Back
        </a>

        <h2 class="text-3xl font-bold text-gray-900">Sign up</h2>
        <p class="text-gray-400 mt-1 mb-8 text-sm">Sign up to join</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-gray-900 mb-1">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="block w-full border-0 border-b-2 border-gray-200 focus:border-[#0d2a63] focus:ring-0 px-0 py-2 text-gray-900 placeholder-gray-300 bg-transparent transition-colors"
                    placeholder="Please type full name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-bold text-gray-900 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="block w-full border-0 border-b-2 border-gray-200 focus:border-[#0d2a63] focus:ring-0 px-0 py-2 text-gray-900 placeholder-gray-300 bg-transparent transition-colors"
                    placeholder="email@example.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <label for="password" class="block text-sm font-bold text-gray-900 mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
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

            <div class="mb-10 relative">
                <label for="password_confirmation" class="block text-sm font-bold text-gray-900 mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="block w-full border-0 border-b-2 border-gray-200 focus:border-[#0d2a63] focus:ring-0 px-0 py-2 text-gray-900 placeholder-gray-300 bg-transparent transition-colors"
                    placeholder="********">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div>
                <button type="submit" class="w-full bg-[#0d2a63] hover:bg-blue-900 text-white font-semibold py-3.5 rounded-full shadow-[0_10px_20px_rgba(13,42,99,0.25)] transition duration-200">
                    Sign up
                </button>
            </div>

            <div class="mt-8 text-center text-sm text-gray-400">
                have an account? <a href="{{ route('login') }}" class="font-bold text-[#0d2a63] hover:underline">Sign in</a>
            </div>
        </form>
    </div>
</x-guest-layout>
