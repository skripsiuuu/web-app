<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#476024] shadow-sm focus:ring-[#476024]" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingatkan saya') }}</span>
            </label>
        </div>

        <!-- Bagian Bawah Form (Register, Forgot Pass, & Button) -->
        <div class="flex flex-col sm:flex-row items-center justify-between mt-6 gap-4">
            
            <!-- Link Register (Kiri) -->
            @if (Route::has('register'))
                <a class="text-sm text-gray-600 hover:text-[#476024] underline transition focus:outline-none" href="{{ route('register') }}">
                    Belum punya akun? Daftar di sini
                </a>
            @endif

            <!-- Link Lupa Password & Tombol Login (Kanan) -->
            <div class="flex items-center gap-4 w-full sm:w-auto justify-end">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-[#476024] underline transition focus:outline-none" href="{{ route('password.request') }}">
                        Lupa Kata Sandi?
                    </a>
                @endif

                <!-- Tombol Hijau Andalan -->
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-[#476024] hover:bg-[#364a1b] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150 shadow-md">
                    MASUK
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>
