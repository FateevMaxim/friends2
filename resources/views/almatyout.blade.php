@if(isset($config->address)) @section( 'chinaaddress', $config->address ) @endif
@if(isset($config->title_text)) @section( 'title_text', $config->title_text ) @endif
@if(isset($config->address_two)) @section( 'address_two', $config->address_two ) @endif

<x-app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @if(session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800" role="alert">
                        <span class="font-medium">{{ session()->get('message') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 max-w-3xl mx-auto md:grid-cols-2 h-22 pl-6 pr-6 pb-4">

                        <div class="min_height round_border p-4 relative">
                            <div>
                                <h3 class="mt-0 p-4 text-2xl font-medium leading-tight text-primary">Пункт выдачи Алматы</h3>
                            </div>
                            <form method="POST" action="{{ route('getinfo-product') }}" id="getInfoForm">
                                <div class="w-full">
                                    <x-input-label for="phone" :value="__('Трек код')" />
                                    @csrf
                                    <x-text-input id="track_code" class="block mt-1 w-full border-2 border-sky-400" type="text" name="track_code" autofocus />
                                </div>
                            </form>
                            <div class="absolute p-4 bottom-0">
                                <h3 class="mt-0 text-2xl font-medium leading-tight text-primary">Выдано сегодня: {{ $count }}</h3>
                            </div>

                        </div>

                        <div class="grid md:mt-0 mt-4 p-4 min_height round_border relative">
                            <div class="grid mt-5">
                                <div>
                                    <h4 class="mt-0 text-xl font-medium leading-tight text-primary">Данные клиента</h4>
                                    <h5 id="block" class="mt-0 text text-red-400 font-medium leading-tight text-primary" style="display: none;">Клиент находится в чёрном списке</h5>
                                    <h5 id="unknown" class="mt-0 text text-red-400 font-medium leading-tight text-primary" style="display: none;">Неопознанный трек код</h5>

                                    <p><b>Имя:</b> <span id="surnamename"></span> &nbsp; <span id="name"></span></p>
                                    <p><b>Номер телефона:</b> <span id="login"></span></p>
                                    <p><b>Город:</b> <span id="city"></span></p>

                                    <p><b>Трек код:</b> <span id="trackcode"></span></p>

                                    <h4 class="mt-4">Дата регистрации в Китае</h4>
                                    <p><small id="to_china"></small></p>
                                    <h4>Дата регистрации в Алматы</h4>
                                    <p><small id="to_almaty"></small></p>
                                    <h4>Дата выдачи клиенту</h4>
                                    <p><small id="to_client"></small></p>
                                    <h4>Дата получения клиентом</h4>
                                    <p><small id="client_accept"></small></p>
                                </div>
                            </div>

                            <div class="absolute w-full bottom-0 p-4">
                                <form method="POST" action="{{ route('almatyout-product') }}" id="almatyOut">
                                        <div class="w-full">
                                            @csrf

                                            <x-primary-button class="mx-auto w-full">
                                                {{ __('Выдать клиенту') }}
                                            </x-primary-button>
                                            <x-secondary-button class="mx-auto mt-4 w-full" id="clear">
                                                {{ __('Отправить дальше') }}
                                            </x-secondary-button>
                                        </div>
                                </form>
                            </div>

                        </div>
                        <script>

                            /* прикрепить событие submit к форме */
                            $("#getInfoForm").submit(function(event) {
                                /* отключение стандартной отправки формы */
                                event.preventDefault();

                                /* собираем данные с элементов страницы: */
                                var $form = $( this ),
                                    track_code = $("#track_code").val();
                                    url = $form.attr( 'action' );

                                /* отправляем данные методом POST */
                                $.post( url, { track_code: track_code } )
                                 .done(function( data ) {
                                     $("#surname").text(data[1].surname);
                                     $("#name").text(data[1].name);
                                     $("#login").text(data[1].login);
                                     $("#city").text(data[1].city);
                                     $("#to_china").text(data[0].to_china);
                                     $("#trackcode").text(track_code);
                                     $("#to_almaty").text(data[0].to_almaty);
                                     $("#to_client").text(data[0].to_client);
                                     $("#client_accept").text(data[0].client_accept);

                                     if (data[1].block === 'нет'){
                                         $("#unknown").css("display","block");
                                     }else if(data[1].block != null){
                                         $("#block").css("display","block");
                                     }else{
                                         $("#block").css("display","none");
                                         $("#unknown").css("display","none");
                                     }

                                 });
                            });

                            /* прикрепить событие submit к форме */
                            $("#almatyOut").submit(function(event) {
                                /* отключение стандартной отправки формы */
                                event.preventDefault();

                                /* собираем данные с элементов страницы: */
                                var $form = $( this ),
                                    track_codes = $("#trackcode").text();
                                    url = $form.attr( 'action' );

                                /* отправляем данные методом POST */
                                $.post( url, { track_codes: track_codes } )
                                 .done(function( data ) {
                                     location.reload();
                                 });

                            });

                            /* прикрепить событие submit к форме */
                            $("#clear").click(function(event) {
                                /* отключение стандартной отправки формы */
                                event.preventDefault();

                                    track_codes = $("#trackcode").text();
                                url = 'almatyout-product';

                                /* отправляем данные методом POST */
                                $.post( url, { track_codes: track_codes, send: true } )
                                    .done(function( data ) {
                                        location.reload();
                                    });

                            });

                        </script>
                </div>

                    @include('components.scanner-settings')


        </div>
</x-app-layout>
