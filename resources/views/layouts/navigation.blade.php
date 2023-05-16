
    <nav x-data="{ open: false }" class="bg-[#313131] border-b border-gray-100">
        <!-- Primary Navigation Menu -->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex text-white items-center">
                        <a href="{{ route('dashboard') }}">
                            <h2 style="font-size:30px; font-weight: bold;">@yield( 'title_text' )</h2>
                            {{--<x-navigation-logo class="block h-9 w-auto fill-current text-gray-800" />--}}
                        </a>
                    </div>

                   {{-- <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Заказы') }}
                        </x-nav-link>
                    </div>--}}
                </div>

                @if(\Illuminate\Support\Facades\Auth::user()->is_active == true)
                <!-- drawer init and toggle -->
                <div class="text-center mt-2">
                    <button class="text-white font-bold px-5 py-2.5 mr-2 mb-2" type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                <!-- drawer component -->
                <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Закрыть</span>
                    </button>
                    @if(Auth::user()->code)
                        <div class="p-2 mt-8 -mb-6">
                            <p class="mb-6 text-dark font-bold">Ваш код: <span class="text-2xl">{{ Auth::user()->code }}</span></p>
                        </div>
                    @endif

                    <div class="bg-[#b6da3a82] p-2 mt-8 mb-4">
                        <p class="mb-6 text-sm text-dark font-bold">Адрес склада в Китае</p>
                        <p class="mb-6 text-sm text-dark" id="china">@yield( 'chinaaddress' ) <br />
                            <b>({{ \Illuminate\Support\Facades\Auth::user()->login }}){{ \Illuminate\Support\Facades\Auth::user()->name }} </b><br />
                            收货人: <b>@yield( 'title_text' )({{ Auth::user()->city }})</b> <br />
                            电话: <b>@yield( 'address_two' )</b>
                        </p>
                        <p class="mb-6 text-sm text-dark" style="display: none;" id="chinaaddress">@yield( 'address_two' )@yield( 'chinaaddress' )</p>
                        <button onclick="copyText()" class="focus:outline-none text-white bg-[#b6da3a] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Копировать</button>
                    </div>

                    <div class="bg-[#fab4b4] p-2 mt-4 mb-4">
                        <p><span>Образец</span></p>
                        <img src="{{asset('images/china.jpg')}}" alt="China">
                    </div>

                    {{--<div class="bg-gray-200 p-2 mt-4 mb-4">
                        <p class="leading-4"><small>Для более удобного пользования сайтом добавьте на главный экран Вашего телефона приложение</small></p>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="https://youtu.be/0j5jX8ufoFs" target="_blank" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">{{ __('Iphone') }}</a>
                            <button onclick="install()" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">{{ __('Android') }}</button>
                        </div>
                    </div>--}}


                    <hr class="h-px my-8 bg-gray-200 border-0">
                    <div class="grid grid-cols-2 mt-4 gap-4">
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">{{ __('Профиль') }}</a>
                        <form method="POST" action="{{ route('logout') }}" class="flex inline-flex"><a onclick="event.preventDefault();
                          this.closest('form').submit();" class="w-full justify-center inline-flex cursor-pointer px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">{{ __('Выйти') }}</a></form>
                    </div>
                </div>
                <script>
                    function copyText() {
                        /* Copy text into clipboard */
                        var chinaaddress = $("#chinaaddress").html();
                        navigator.clipboard.writeText(chinaaddress);
                    }

                </script>
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
                @endif
            </div>
        </div>
    </nav>

