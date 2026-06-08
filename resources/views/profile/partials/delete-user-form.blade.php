<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus Akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6" onsubmit="handleHapusAkun(event)">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Kata Sandi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" id="btnHapusAkun">
                    {{ __('Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <div id="popup-delete" class="fixed inset-0 z-[100] flex items-center justify-center hidden bg-black/60 backdrop-blur-sm transition-opacity">
        <div class="bg-white p-8 rounded-2xl shadow-2xl flex flex-col items-center text-center max-w-sm w-full mx-4 transform transition-all">
            <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mb-5 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Akun Dihapus!</h3>
            <p class="text-sm text-gray-600 mb-6 leading-relaxed">Anda baru saja menghapus akun Anda. Terima kasih telah menggunakan layanan Mitra Hidup Sehat.</p>
            
            <div class="w-full bg-gray-100 rounded-full h-1.5 mb-3 overflow-hidden">
                <div class="bg-red-500 h-1.5 rounded-full" style="animation: loadBar 10s linear forwards;"></div>
            </div>
            <p class="text-xs text-gray-400 font-medium">Mengalihkan ke halaman utama dalam <span id="countdown" class="text-red-500 font-bold">10</span> detik...</p>
        </div>
    </div>

    <style>
        @keyframes loadBar { 
            from { width: 0%; } 
            to { width: 100%; } 
        }
    </style>

    <script>
        function handleHapusAkun(event) {
            event.preventDefault(); // Tahan pengiriman form biasa
            const form = event.target;
            const btn = document.getElementById('btnHapusAkun');
            
            btn.innerText = 'Memproses...';
            btn.disabled = true;

            // Tembak data ke backend secara diam-diam (AJAX)
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => {
                if (response.status === 422) {
                    // Kalo status 422 (Error Validasi / Password Salah), kita biarin Laravel ngurusnya pake submit biasa
                    form.submit(); 
                } else {
                    // Password Bener -> Akun Berhasil Dihapus
                    // 1. Munculin Pop-Up
                    document.getElementById('popup-delete').classList.remove('hidden');
                    
                    // 2. Bikin Hitung Mundur (Countdown) 10 Detik
                    let timeLeft = 10;
                    const countdownEl = document.getElementById('countdown');
                    const timer = setInterval(() => {
                        timeLeft--;
                        countdownEl.innerText = timeLeft;
                        if (timeLeft <= 0) {
                            clearInterval(timer);
                            // 3. Waktu Habis -> Tendang ke Homepage
                            window.location.href = '/'; 
                        }
                    }, 1000);
                }
            }).catch(error => {
                // Kalo ada error sistem, balikin normal
                form.submit();
            });
        }
    </script>
</section>