@if(isset($config->address)) @section( 'chinaaddress', $config->address ) @endif
@if(isset($config->title_text)) @section( 'title_text', $config->title_text ) @endif
@if(isset($config->address_two)) @section( 'address_two', $config->address_two ) @endif
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session()->has('message'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <span class="font-medium">{{ session()->get('message') }}
                </div>
            @endif
            <div class="grid md:grid-cols-3 grid-cols-1 gap-3 h-22 pl-6 pr-6 pb-4">
                <div class="grid grid round_border min_height grid-cols-1 p-4 relative">
                    <div>
                                 <span>
                                Пункт приёма
                                </span>
                        <h3>China</h3>
                    </div>
                    <div class="absolute p-4 bottom-0">
                        <span>今日已上传</span>
                        <h3>{{ $count }}</h3>
                    </div>

                </div>
                <div id="track_codes_list" class="round_border min_height p-4">

                </div>
                <div class="grid hidden" id="clear_track_codes">

                </div>
                <div class="grid grid-cols-1 p-4 min_height round_border relative">
                    <div class="grid mx-auto">
                        <div id="qrcode"></div>
                        <b class="mx-auto" style="margin-top: -45px;">上传数据</b>
                    </div>
                    <div id="track">
                        <span>扫描数量</span>

                        <div x-data="{ count: 0 }">
                            <h1 id="count"></h1>
                        </div>
                    </div>
                    <div class="absolute w-full bottom-0 p-4">
                        <form method="POST" action="{{ route('china-product') }}" id="searchForm">
                            <div>
                                <div>
                                    @csrf

                                    <x-primary-button class="mx-auto w-full">
                                        {{ __('保存数据') }}
                                    </x-primary-button>
                                    <x-secondary-button class="mx-auto mt-4 w-full" id="clear">
                                        {{ __('清楚数据') }}
                                    </x-secondary-button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

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
                        $.post( url, { track_codes: track_codes } )
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
            @include('components.ch_scanner-settings')
        </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/datepicker.min.js"></script>
