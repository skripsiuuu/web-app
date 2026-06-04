<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Anda dapat mengubah detail informasi profil disini.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-100 text-gray-500 cursor-not-allowed border-gray-300" :value="old('email', $user->email)" disabled readonly />
            <p class="text-xs text-gray-500 mt-1 font-medium">Email tidak dapat diubah setelah registrasi.</p>
        </div>

        <!-- Nomor Telepon -->
        <div>
            <x-input-label for="phone" :value="__('Nomor Telepon')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="tel" placeholder="Contoh: 081234567890" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!-- Alamat Lengkap -->
        <div>
            <x-input-label for="address" :value="__('Alamat Lengkap')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" autocomplete="street-address" placeholder="Contoh: Jl. Merdeka No. 10, RT 01/RW 02" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <!-- Kode Pos -->
        <div>
            <x-input-label for="postal_code" :value="__('Kode Pos')" />
            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $user->postal_code)" autocomplete="postal-code" placeholder="Contoh: 12345" />
            <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-[#476024] hover:bg-[#364a1b]">{{ __('Simpan') }}</x-primary-button>
        </div>
    </form>
    @if (session('status') === 'profile-updated')
        <div id="toast-profile" class="fixed bottom-6 right-6 z-50 flex items-center w-full max-w-xs p-4 text-gray-700 bg-white rounded-xl shadow-xl border border-gray-100 transform transition-all duration-500 translate-y-0 opacity-100" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="ms-3 text-sm font-semibold">Data profil berhasil diubah!</div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-profile');
                if (toast) {
                    toast.classList.add('translate-y-4', 'opacity-0');
                    setTimeout(() => toast.remove(), 500); 
                }
            }, 3000); // Hilang otomatis setelah 3 detik
        </script>
    @endif
</section>
