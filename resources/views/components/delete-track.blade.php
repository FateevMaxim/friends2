
<button data-modal-target="defaultModal{{$track->id}}" data-modal-toggle="defaultModal{{$track->id}}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
    </svg>
</button>

<!-- Main modal -->
<div id="defaultModal{{$track->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-3/4 max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-white">
                    {{$track->track_code}}
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6 text-center space-y-6">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    Внимание!!!<br />
                    Удалить трек код?
                </p>
            </div>
            <form method="POST" action="{{ route('delete-track') }}">
                @csrf
                <x-text-input type="hidden" name="delete_track" value="{{$track->track_code}}" />

                <!-- Modal footer -->
                <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                    <button data-modal-hide="defaultModal{{$track->id}}" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Да</button>
                    <button data-modal-hide="defaultModal{{$track->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                </div>
            </form>
        </div>
    </div>
</div>
