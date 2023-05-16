@if(isset($config->address)) @section( 'chinaaddress', $config->address ) @endif
@if(isset($config->title_text)) @section( 'title_text', $config->title_text ) @endif
@if(isset($config->address_two)) @section( 'address_two', $config->address_two ) @endif

<x-app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="grid grid-cols-1 mx-auto md:grid-cols-3 h-22 pl-6 pr-6 pb-4">

                        <div class="min_height round_border p-4 relative">
                            <div>
                                <h3 class="mt-0 p-4 text-2xl font-medium leading-tight text-primary">Пункт отправки в другой город</h3>
                            </div>
                            <div class="absolute p-4 bottom-0">
                                <span>Количество зарегистрированных трек кодов за сегодня</span>
                                <h3 class="mt-0 text-2xl font-medium leading-tight text-primary">{{ $count }}</h3>
                            </div>

                        </div>
                    <div id="track_codes_list" class="round_border min_height p-4">

                    </div>
                    <div class="grid hidden" id="clear_track_codes">

                    </div>

                    <div class="grid grid-cols-1 p-4 min_height round_border relative">
                        <div class="grid mx-auto">
                            <div id="qrcode"></div>
                            <b class="mx-auto" style="margin-top: -45px;">Upload Data</b>
                        </div>
                        <div id="track">
                            <span>Счётчик</span>

                            <div x-data="{ count: 0 }">
                                <h1 id="count"></h1>
                            </div>
                        </div>
                        <div class="absolute w-full bottom-0 p-4">
                            <form method="POST" action="{{ route('almatyout-product') }}" id="searchForm">
                                <div>
                                    <div>
                                        @csrf

                                        <x-primary-button class="mx-auto w-full">
                                            {{ __('Отправить') }}
                                        </x-primary-button>
                                        <x-secondary-button class="mx-auto mt-4 w-full" id="clear">
                                            {{ __('Очистить') }}
                                        </x-secondary-button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                       {{-- <div id="track_codes_list" class="min_height round_border md:mt-0 mt-4 p-4">

                        </div>
                        <div class="grid hidden" id="clear_track_codes">

                        </div>--}}

                        <script>

                            let code = "";
                            var number = 1;

                            document.addEventListener('keypress', e => {
                                if (e.key === "Enter") {
                                    $('#track_codes_list').append('<h2>'+number+'. '+code+'</h2>');
                                    $('#clear_track_codes').append(code+'\r\n');
                                    $("#count").text(number);
                                    number++;
                                    code = "";
                                } else {
                                    if(e.code[0] === "D"){
                                        code += e.code[5]
                                        return
                                    }
                                    code += e.code[3];
                                }
                            });

                            /* прикрепить событие submit к форме */
                            $("#searchForm").submit(function(event) {
                                /* отключение стандартной отправки формы */
                                event.preventDefault();

                                /* собираем данные с элементов страницы: */
                                var $form = $( this ),
                                    track_codes = $("#clear_track_codes").html();
                                    url = $form.attr( 'action' );

                                /* отправляем данные методом POST */
                                $.post( url, { track_codes: track_codes, send: true } )
                                 .done(function( data ) {
                                     location.reload();
                                 });

                            });

                            /* прикрепить событие submit к форме */
                            $("#clear").click(function(event) {
                                /* отключение стандартной отправки формы */
                                event.preventDefault();

                                     $("#track_codes_list").html('');
                                     $("#clear_track_codes").html('');
                                        number = 1;
                                     $("#count").text('0');

                            });

                        </script>
                </div>

                @include('components.scanner-settings')

        </div>
</x-app-layout>
