<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="content p-4" >
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-10 gap-4">
            <!-- New Accounts Section -->
            <div class="col-span-1 md:col-span-5 p-6 md:px-20 lg:px-35 ">
                <h4 class="text-2xl font-bold mb-2">New Accounts</h4>
                <hr class="mb-4" />
                <p class="mb-4">
                    Only one email address may be associated
                    with an account. If you have previously
                    registered with Straits Financial, login
                    with the username and password provided
                    previously and assigned to your email
                    address. You can save your progress at
                    anytime and return by logging in with the
                    username and password provided.
                </p>

                @if (Route::has('register'))
                    <p class="text-center mt-4">
                        <a id="regis-btn" class="text-white p-2 rounded transition ease-in-out duration-150" href="{{ route('register') }}">Register as a new user</a>
                    </p>
                @endif

            </div>

            <!-- Login Section -->
            <div class="col-span-1 md:col-span-5 p-6 md:px-20 lg:px-35">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h4 class="text-2xl font-bold my-2">Welcome back!</h4>
                    <hr class="my-4" />
                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full px-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full px-2" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mb-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end">
                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif

                        <button id="login-btn" type="submit" class="ms-3 text-white inline-flex items-center px-4 py-2  border-transparent rounded-md transition ease-in-out duration-150 ">
                           Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
