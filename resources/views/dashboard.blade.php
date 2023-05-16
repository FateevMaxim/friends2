@if(isset($config->address)) @section( 'chinaaddress', $config->address ) @endif
@if(isset($config->title_text)) @section( 'title_text', $config->title_text ) @endif
@if(isset($config->address_two)) @section( 'address_two', $config->address_two ) @endif

<x-app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full h-22 pl-4 pr-4 pb-4">
                    <div class="grid h-full grid-cols-3 mx-auto circleBaseTwo circle2">
                            <button type="button" class="inline-flex flex-col items-center justify-center px-5">
                                <span class="text-sm text-white leading-8">@if($count) Треков: {{$count}} @endif</span>
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
                        <a href="{{ route('archive') }}" class="inline-flex flex-col items-center justify-center px-5">
                            <button type="button">
                                <div class="items-center">
                                    <span class="text-sm text-white leading-8">АРХИВ</span>
                                </div>
                            </button>
                        </a>
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
                                <h4 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Добавление трек кода</h4>
                                <form method="POST" action="{{ route('client-product') }}">
                                    @csrf
                                    <x-text-input id="track_code" class="block mt-1 w-full mb-2 border-2" type="text" required="required" placeholder="Введите трек код" name="track_code" :value="old('track_code')" required autofocus autocomplete="track_code" />
                                    <textarea id="detail" name="detail" rows="5" required="required" class="block mb-2 mx-auto w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Детали..."></textarea>
                                    <button type="submit" class="items-center px-4 py-3 bg-[#6e6e6e] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Добавить') }}
                                    </button>
                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
                @if(Route::currentRouteName() != 'dashboard')
                    <div class="flex items-center justify-start mt-2 ml-6">
                        <a href="{{ route('dashboard') }}">
                            <x-primary-button class="mx-auto mb-4 w-full">
                                {{ __('Назад') }}
                            </x-primary-button>
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
                        <div id="alert-2" class="flex mr-6 ml-6 p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                            <div class="ml-3 text-sm font-medium">
                                {{ $message->message }}
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->type === 'admin' || \Illuminate\Support\Facades\Auth::user()->type === 'moderator')
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                                    <span class="sr-only">Закрыть</span>
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            @endif

                        </div>
                    @endforeach
                @endif
                <div class="grid grid-cols-1 sm:grid-cols-3 ml-5 mr-5 gap-2">

                    @foreach($tracks as $track)
                        <div class="w-full bg-white border border-indigo-200 rounded-lg shadow">
                            <ul class="grid grid-cols-1 p-3 text-xl font-medium text-white border-b border-gray-200 rounded-t-lg"
                                @if($track->to_china == null && $track->to_almaty == null && $track->to_client == null && $track->client_accept == null) style="background-color: rgb(168 168 168);" @endif
                                @if($track->created_at != null && $track->to_china != null && $track->to_almaty == null && $track->to_client == null && $track->client_accept == null ) style="background-color: rgb(255 198 53);" @endif
                                @if($track->created_at != null && $track->to_almaty != null && $track->to_client == null && $track->client_accept == null )  style="background-color: rgb(0 218 76);" @endif
                                @if($track->created_at != null && $track->to_client != null && $track->client_accept == null )  style="background-color: rgb(53 174 255);" @endif
                                @if($track->created_at != null && $track->client_accept != null )  style="background-color: rgb(230 123 253);" @endif>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-2 ml-5">
                                        <span>{{$track->track_code}}</span>
                                    </div>
                                    @if(Route::currentRouteName() != 'archive')
                                    <div class="flex flex-row-reverse col-span-1">
                                        <li class="mr-4">
                                            @include('components.delete-track')
                                        </li>
                                        <li class="mr-4">
                                            <form method="POST" action="{{ route('client-product-archive') }}">
                                                @csrf
                                                <x-text-input type="hidden" name="archive_track" value="{{$track->track_code}}" />
                                                <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </li>
                                    </div>
                                        @elseif(Route::currentRouteName() === 'archive')
                                        <div class="flex flex-row-reverse col-span-1">
                                            <li class="mr-4">
                                                @include('components.delete-track')
                                            </li>
                                            <li class="mr-4">
                                                <form method="POST" action="{{ route('client-product-unarchive') }}">
                                                    @csrf
                                                    <x-text-input type="hidden" name="archive_track" value="{{$track->track_code}}" />
                                                    <button type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                                                        </svg>
                                                    </button>
                                                </form>

                                            </li>
                                        </div>
                                    @endif
                                </div>
                            </ul>
                            <div id="defaultTabContent" class="p-4">
                                <h2 class="mb-2 text-lg font-semibold text-gray-900">{{$track->detail}}</h2>
                                <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                                    <li class="flex items-center">
                                        <svg class="w-6 h-6 mr-1.5 @if($track->created_at == null) text-gray-200 @endif text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <p><small>Дата регистрации клиентом</small><br />
                                            <span> {{$track->created_at}}</span><p>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-6 h-6 mr-1.5 @if($track->to_china == null) text-gray-200 @else text-green-400 @endif flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <p><small>Получено на складе в Китае</small><br />
                                            <span>{{$track->to_china}}</span></p>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-6 h-6 mr-1.5 @if($track->to_almaty == null) text-gray-200 @else text-green-400 @endif flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <p><small>Получено на складе в Алматы</small><br />
                                            <span>{{$track->to_almaty}}</span></p>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-6 h-6 mr-1.5 @if($track->to_client == null) text-gray-200 @else text-green-400 @endif flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <p><small>@if($track->status === 'Отправлено в Ваш город') Отправлено в Ваш город @else Получено клиентом @endif</small><br />
                                            <span>{{$track->to_client}}</span></p>
                                    </li>
                                    <li class="grid items-center">

                                        <div class="flex">
                                            <svg class="w-6 h-6 mr-1.5 @if($track->client_accept == null) text-gray-200 @else text-green-400 @endif flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p><small>Товар принят</small><br />
                                                <span>{{$track->client_accept}}</span></p>
                                        </div>

                                        @if($track->to_client && $track->client_accept == null)
                                            <div class="mt-4">
                                                <form method="POST" action="{{ route('accept-product', ['track_code' => $track->track_code]) }}">
                                                    <x-classic-button class="w-9/12 mx-auto w-full justify-center inline-flex">
                                                        {{ __('Принять товар') }}
                                                    </x-classic-button>
                                                </form>
                                            </div>

                                        @endif
                                    </li>


                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

</x-app-layout>
