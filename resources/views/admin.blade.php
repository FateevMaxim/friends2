@if(isset($config->address)) @section( 'chinaaddress', $config->address ) @endif
@if(isset($config->title_text)) @section( 'title_text', $config->title_text ) @endif
@if(isset($config->address_two)) @section( 'address_two', $config->address_two ) @endif
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full h-22 pl-4 pr-4 pb-4">
                <div class="grid h-full grid-cols-3 mx-auto circleBaseTwo circle2">
                    <button type="button" class="inline-flex flex-col items-center justify-center px-5">
                    </button>
                    <div class="mx-auto">
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="inline-flex flex-col items-center justify-center px-5">
                            <div class="circleBase circle1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-11 h-11 block mx-auto mt-2 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </button>
                    </div>
                    @if(Auth::user()->type === 'admin')<a href="{{ route('result') }}" class="inline-flex flex-col items-center justify-center px-5">
                        <button type="button">
                            <div class="items-center">
                                <span class="text-sm text-white leading-8">Итоги</span>
                            </div>
                        </button>
                    </a>@endif
                </div>
            </div>
            <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-full h-full max-w-md md:h-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Закрыть</span>
                        </button>
                        <div class="p-6 text-center">
                            <h4 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Добавление сообщения</h4>
                            <form method="POST" action="{{ route('message-add') }}">
                                <textarea id="message" name="message" rows="5" required="required" class="block mb-2 mx-auto w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Сообщение..."></textarea>
                                <button type="submit" class="items-center px-4 py-3 bg-fuchsia-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Отправить сообщение') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(Route::currentRouteName() != 'dashboard')
                <div class="flex items-center justify-start mt-2 ml-6">
                    <a href="{{ route('dashboard') }}">
                        <x-classic-button class="mx-auto mb-4 w-full">
                            {{ __('Назад') }}
                        </x-classic-button>
                    </a>
                </div>
            @endif
            @if(session()->has('message'))
                <div id="alert-3" class="flex p-4 mb-4 mr-6 ml-6 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <div class="ml-3 text-sm font-medium">
                        {{ session()->get('message') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Закрыть</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            @endif
            @if(session()->has('error'))
                <div id="alert-2" class="flex mr-6 ml-6 p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <div class="ml-3 text-sm font-medium">
                        {{ session()->get('error') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Закрыть</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            @endif
            @if(Route::currentRouteName() === 'dashboard')
                @foreach($messages as $message)
                    <div id="alert-2" class="flex justify-between mr-6 ml-6 p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                        <div class="flex flex-row ml-3 text-sm font-medium">
                            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                            &nbsp;{{ $message->message }}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->type === 'admin' || \Illuminate\Support\Facades\Auth::user()->type === 'moderator')
                            <form method="POST" action="{{ route('message-delete', ['id' => $message->id]) }}">
                                <button type="submit" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                                    <span class="sr-only">Закрыть</span>
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @endif

            <div class="grid grid-cols-1 mr-6 mb-4 mt-2 ml-6">
                <form method="POST" action="{{ route('client-search') }}">
                    @csrf
                    <x-text-input id="phone" class="block mt-1 w-full mb-2 border-2 border-sky-400" type="text" required="required" placeholder="Введите запрос" name="phone" value="{{ $search_phrase }}" required autofocus />
                    <button type="submit" class="items-center px-4 py-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: rgb(49 196 141)">
                        {{ __('Поиск') }}
                    </button>
                </form>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 ml-5 mr-5 gap-2">
                @foreach($users as $user)
                    <div class="w-full bg-white border border-indigo-200 rounded-lg shadow">
                        <ul class="grid grid-cols-1 p-3 text-xl font-medium text-white border-b border-gray-200 rounded-t-lg"
                            @if($user->is_active == true && $user->block == false && $user->type != 'deleted') style="background-color: rgb(49 196 141);"
                            @elseif($user->type == 'deleted') style="background-color: rgb(28 28 28);"
                            @elseif($user->block == true) style="background-color: rgb(205 51 51);"
                            @else style="background-color: rgb(194 194 194);" @endif>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-2 ml-5">
                                    <span data-tooltip-target="tooltip-click{{$user->id}}" data-tooltip-trigger="click" class="cursor-pointer">{{$user->login}}</span>
                                    <div id="tooltip-click{{$user->id}}" role="tooltip" class="absolute left-0 z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                        {!! $user->password !!}
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>
                                    <div class="flex flex-row-reverse col-span-1">
                                        <li class="mr-4">

                                            <button data-modal-target="defaultModal{{$user->id}}" data-modal-toggle="defaultModal{{$user->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>

                                            <!-- Main modal -->
                                            <div id="defaultModal{{$user->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                                <div class="relative w-3/4 max-w-md md:h-auto">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow">
                                                        <!-- Modal header -->
                                                        <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                                                            <h3 class="text-xl font-semibold text-white">
                                                                {{$user->name}}
                                                            </h3>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-6 text-center space-y-6">
                                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                                Внимание!!!<br />
                                                                Удалить клиента и все его трек коды?
                                                            </p>
                                                        </div>
                                                        <form method="POST" action="{{ route('client-delete', ['id' => $user->id]) }}">
                                                            @csrf
                                                            <!-- Modal footer -->
                                                            <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                                <button data-modal-hide="defaultModal{{$user->id}}" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Да</button>
                                                                <button data-modal-hide="defaultModal{{$user->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mr-4">
                                            <form method="POST" action="{{ route('client-block', ['id' => $user->id]) }}">
                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </li>
                                    </div>
                            </div>
                        </ul>
                        <div id="defaultTabContent" class="p-4">
                            <h2 class="mb-2 text-lg font-semibold text-gray-900">{{$user->surname}}&nbsp;{{$user->name}}</h2>
                            <ul class="max-w-md space-y-1 text-gray-500 list-inside">
                                <li class="flex items-center">
                                    <p><small>Город</small><br />
                                        <span>{{$user->city}}</span></p>
                                </li>
                                <li class="flex items-center">
                                    <p><small>Дата регистрации</small><br />
                                        <span>{{$user->created_at}}</span></p>
                                </li>
                                <li class="flex items-center">
                                    <p><small>Код</small><br />
                                        <span>{{$user->code}}</span></p>
                                </li>
                                <li class="grid justify-center text-center gap-4">
                                    <form method="POST" action="{{ route('client-access', ['id' => $user->id] ) }}" class="grid items-center w-full justify-end mt-4">
                                        <x-classic-button>
                                            @if($user->is_active == true) {{ __('Заблокировать') }} @else {{ __('Дать доступ') }} @endif
                                        </x-classic-button>
                                    </form>
                                    <x-secondary-button data-modal-target="editModal{{$user->id}}" data-modal-toggle="editModal{{$user->id}}" class="grid items-center w-full justify-end py-3">
                                        Редактировать
                                    </x-secondary-button>

                                    <!-- Main modal -->
                                    <div id="editModal{{$user->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                        <div class="relative w-3/4 max-w-md md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                                                    <h3 class="text-xl font-semibold text-white">
                                                        {{$user->name}}
                                                    </h3>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-6 text-center space-y-4">
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Внимание!!!<br />
                                                        Вы редактируете город клиента
                                                    </p>
                                                </div>
                                                <form method="POST" action="{{ route('client-edit') }}">
                                                    @csrf
                                                    <label for="editCity" class="grid w-9/12 mx-auto mb-4">
                                                        <x-input-label for="editCity" :value="__('Город')" />
                                                        <x-text-input type="text" name="editCity" value="{{$user->city}}" />
                                                    </label>

                                                    <input type="hidden" name="userId" value="{{$user->id}}" />
                                                    <!-- Modal footer -->
                                                    <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                        <button data-modal-hide="editModal{{$user->id}}" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Да</button>
                                                        <button data-modal-hide="editModal{{$user->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
