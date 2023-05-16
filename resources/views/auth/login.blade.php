<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-text-input id="login" class="block phone mt-1 w-9/12 mx-auto border-2 border-sky-400" type="text" placeholder="+7 701 775 7272" name="login" :value="old('login')" required autofocus autocomplete="login" />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-text-input id="password" class="block mt-1 w-9/12 mx-auto border-2 border-sky-400"
                            type="password"
                            name="password"
                            placeholder="Пароль"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 w-9/12 mx-auto">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Запомнить') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-9/12 mx-auto">
                {{ __('Войти') }}
            </x-primary-button>
        </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('register') }}" class="grid w-9/12 mx-auto">
                    <x-secondary-button>
                        {{ __('Зарегистрироваться') }}
                    </x-secondary-button>
                </a>
            </div>
        @if(isset($config->whats_app))
            <div class="flex items-center justify-end mt-4">
                <a href="https://api.whatsapp.com/send?phone={{$config->whats_app}}&text=Здравствуйте! Напомните, пожалуйста, мой пароль" class="w-9/12 mx-auto">
                    Забыли пароль?
                </a>
            </div>
        @endif

<div class="flex w-9/12 gap-2 mt-4 mx-auto md:justify-between">
    <div class="grid w-full">
        <a onclick="install()" class="w-full cursor-pointer mx-auto px-4 py-2 text-sm font-medium text-center text-gray-900
        bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">{{ __('Android') }}</a>
    </div>
    <div class="grid w-full">
        <a href="https://youtu.be/0j5jX8ufoFs" target="_blank" class="w-full mx-auto px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                {{ __('Iphone') }}
        </a>
    </div>

</div>
        <script>
            let deferredPrompt = null;

            window.addEventListener('beforeinstallprompt', function(e) {
                // Prevent Chrome 67 and earlier from automatically showing the prompt
                e.preventDefault();
                // Stash the event so it can be triggered later.
                deferredPrompt = e;
            });

            // Installation must be done by a user gesture! Here, the button click
            async function install() {
                if(deferredPrompt){
                    // Show the prompt
                    deferredPrompt.prompt();
                    // Wait for the user to respond to the prompt
                    deferredPrompt.userChoice.then(function(choiceResult){
                        if (choiceResult.outcome === 'accepted') {
                            console.log('Your PWA has been installed');
                        } else {
                            console.log('User dismissed installation');
                        }
                        deferredPrompt = null;
                    });
                }
            }
        </script>
    </form>
</x-guest-layout>
