@if(isset($config->address)) @section( 'chinaaddress', $config->address ) @endif
@if(isset($config->title_text)) @section( 'title_text', $config->title_text ) @endif
@if(isset($config->address_two)) @section( 'address_two', $config->address_two ) @endif
<style>
    /* Set the chart container width to a percentage value */
    #barchart_values {
        width: 100%;
        height: 1200px;
    }
</style>
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full h-22 pl-4 pr-4 pb-4">
                <div class="grid h-full grid-cols-3 mx-auto circleBaseTwo circle2">
                    <button type="button" class="inline-flex flex-col items-center justify-center px-5">
                    </button>
                    <div class="mx-auto">
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="inline-flex flex-col items-center justify-center px-5">
                            <div class="circleBase circle1" style="margin-top:40px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-11 h-11 block mx-auto mt-2 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </button>
                    </div>
                    <button type="button" class="inline-flex flex-col items-center justify-center px-5">
                        <div class="items-center">
                        </div>
                    </button>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 ml-5 mr-5 mb-2 gap-2">
                <div class="overflow-hidden rounded-lg shadow-lg">
                    <div class="bg-neutral-50 py-3 px-5">
                        Количество зарегистрированных клиентов
                    </div>
                    <canvas id="client-chart" width="400" height="250"></canvas>

                    <p class="ml-4 mb-1 mt-1">
                        Сколько клиентов заходили на сайт сегодня: <b>{{ $clients_auth }}</b>
                    </p>
                    <p class="ml-4 mb-1 mt-1">
                        Количество зарегистрированных трек кодов клиентом на сегодня: <b>{{ $tracks_today }}</b>
                    </p>
                    <p class="ml-4 mb-1 mt-1">
                        Количество зарегистрированных трек кодов клиентом на этот месяц: <b>{{ $tracks_month }}</b>
                    </p>
                </div>
                <div class="overflow-hidden rounded-lg shadow-lg">
                    <div
                        class="bg-neutral-50 py-3 px-5 dark:bg-neutral-700 dark:text-neutral-200">
                        Количество добавленных трек кодов на складах
                    </div>
                    <canvas id="pie-chart" width="800" height="450"></canvas>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-1 ml-5 mr-5 gap-2">
                <div class="overflow-hidden rounded-lg shadow-lg">
                    <div
                        class="bg-neutral-50 py-3 px-5">
                        Количество добавленных трек кодов на складах
                    </div>
                    <div id="barchart_values"></div>
                </div>
            </div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <!-- Required chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>


            <script type="text/javascript">

                Chart.register(ChartDataLabels);
                Chart.defaults.set('plugins.datalabels', {
                    color: '#000'
                });
                var labels =  {{ Js::from($labels) }};
                var users =  {{ Js::from($data) }};

                var users2 =  {{ Js::from($data2) }};
                var users3 =  {{ Js::from($data3) }};
                var clients =  {{ Js::from($clients) }};
                var clients_false =  {{ Js::from($clients_false) }};
                var clients_true =  {{ Js::from($clients_true) }};
                var clients_today =  {{ Js::from($clients_today) }};

                new Chart(document.getElementById("pie-chart"), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "Китай",
                                backgroundColor: "#ff6a00",
                                data: users,
                                stack: 'Stack 0',
                            }, {
                                label: "Алматы",
                                backgroundColor: "#31c48d",
                                data: users2,
                                stack: 'Stack 1',
                            }, {
                                label: "Выдача",
                                backgroundColor: "#0095ff",
                                data: users3,
                                stack: 'Stack 2',
                            }
                        ]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Population growth (millions)'
                        },
                        responsive: true,
                        interaction: {
                            intersect: false,
                        },
                    }
                });

                new Chart(document.getElementById("client-chart"), {
                    type: 'doughnut',
                    data: {
                        labels: [ 'На сегодня: '+clients_today, 'Есть доступ: '+clients_true, 'Нет доступа: '+clients_false,  'Всего: '+clients],
                        datasets: [
                            {
                                label: "Количество",
                                backgroundColor: [ "#3366cc", "#dc3912", "#ff9900", "#109618"],
                                data: [clients_today, clients_true, clients_false,  clients],
                            }
                        ]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                        },

                        responsive: true,
                        interaction: {
                            intersect: false,
                        },
                    }
                });


                var labelsDays =  {{ Js::from($labelsDays) }};
                var usersDays =  {{ Js::from($dataDays) }};

                var usersDays2 =  {{ Js::from($dataDays2) }};
                var usersDays3 =  {{ Js::from($dataDays3) }};

                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Дни');
                    data.addColumn('number', 'Китай');
                    data.addColumn('number', 'Алматы');
                    data.addColumn('number', 'Выдача');
                    for (var i = 0; i < labelsDays.length; i++) {
                        data.addRow([labelsDays[i], usersDays[i], usersDays2[i], usersDays3[i]]);
                    }

                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1, {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    }, 2, {
                        calc: "stringify",
                        sourceColumn: 2,
                        type: "string",
                        role: "annotation"
                    }, 3, {
                        calc: "stringify",
                        sourceColumn: 3,
                        type: "string",
                        role: "annotation"
                    }]);

                    var options = {
                        legend: {position: "top", maxLines: 3},
                        bar: {groupWidth: "70%"},
                        colors: ["#ff6a00", "#31c48d", "#0095ff"],
                        chartArea:{left:70,top:100, right:80, bottom:100}
                    };
                    var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                    chart.draw(view, options);
                    window.addEventListener('resize', function() {
                        chart.draw(view, options);
                    });
                }
            </script>
        </div>
    </div>
</x-app-layout>
