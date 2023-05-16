<x-app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Вы зарегистрированны!</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Добро пожаловать в систему отслеживания посылок из Китая</p>

                    @if(isset($config->whats_app))
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Чтобы получить доступ к сайту переходите по ссылке</p>
                        <a href="https://api.whatsapp.com/send?phone={{$config->whats_app}}&text=Здравствуйте! Активируйте мой аккаунт" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Перейти
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    @endif
                    <div class="grid grid-cols-3 mt-4 gap-4">
                        <form method="POST" action="{{ route('logout') }}" class="flex inline-flex"><a onclick="event.preventDefault();
                          this.closest('form').submit();" class="w-full justify-center inline-flex cursor-pointer px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">{{ __('Выйти') }}</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>

</x-app-layout>
