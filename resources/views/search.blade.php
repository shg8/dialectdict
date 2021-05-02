<x-app-layout>
    @push('scripts')
        <script src="https://unpkg.com/wavesurfer.js"></script>
    @endpush
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative flex items-center w-full mb-6">
                <div class="flex items-center w-full rounded-lg shadow-md">
                    <input
                        id="search-bar-main"
                           class="search-bar block w-full p-4 text-xl border border-gray-200 rounded-lg bg-white bg-opacity-90"
                           autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false" type="text"
                           placeholder="{{ \Backpack\Settings\app\Models\Setting::get('search_bar_placeholder') }}">
                    <button type="button" class="absolute inset-y-0 right-0 flex items-center justify-center mr-5">
                        <x-gmdi-double-arrow-r style="width: 1.5rem" onclick="search($('#search-bar-main').val())"/>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 w-full">
            <div class="col-span-2 sm:px-6 lg:px-8">
                <div class="bg-white bg-opacity-95 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h2>{{ \Backpack\Settings\app\Models\Setting::get('homepage_intro_title') }}</h2>
                    </div>
                    <div class="p-6 border-b border-gray-200">
                        {!! \Backpack\Settings\app\Models\Setting::get('homepage_intro_content') !!}
                    </div>
                </div>
            </div>
            @if(isset($word))
            <div class="mt-6 lg:mt-0 flex flex-col sm:px-6 lg:px-8">
                <div class="bg-white bg-opacity-95 overflow-hidden shadow-sm rounded-lg" style="cursor: pointer"
                     onclick="window.location.href='{{ route('view', $word->id) }}'">
                    <div class="p-6 border-b border-gray-200">
                        <b>Word of the Day</b>
                    </div>
                    <div class="p-6 pb-3 border-gray-200">
                        <b>English:</b> <span class="font-serif"> {{ $word->english }}</span>
                    </div>
                    @if($word->pronunciation || $word->pronunciation_upload)
                        <div class="py-2 hidden" id="waveform-{{ $word->id }}"></div>
                        <div class="p-6 pt-3 border-b border-gray-200 flex flex-row justify-between">
                            <span><b>Pronunciation:</b>
                                @if($word->pronunciation)<span class="font-serif"> {{ $word->pronunciation }}</span>@endif
                            </span>
                            @if($word->pronunciation_upload)
                                <x-heroicon-s-play class="w-6" id="play{{$word->id}}"/>
                                @push('scripts')
                                    <script>
                                        let wavesurfer{{$word->id}} = WaveSurfer.create({
                                            container: document.querySelector('#waveform-{{ $word->id }}'),
                                            barWidth: 1,
                                            barHeight: 1, // the height of the wave
                                            barGap: null // the optional spacing between bars of the wave, if not provided will be calculated in legacy format
                                        });

                                        wavesurfer{{$word->id}}.load('{{ Storage::url($word->pronunciation_upload) }}');

                                        $("#play{{$word->id}}").click(function(e) {
                                            e.stopPropagation();
                                            wavesurfer{{$word->id}}.play();
                                        });
                                    </script>
                                @endpush
                            @endif
                        </div>
                    @endif
                </div>

                <div class="mt-6 bg-white bg-opacity-95 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <b>Recent Updates</b>
                    </div>
                    @foreach($recent_updates as $word)
                        <div class="pl-6 p-4 @if(!$loop->last) pb-0 @endif">
                            <span onclick="window.location.href='{{ route('view', $word->id) }}'"
                                  style="cursor:pointer;">
                            <span class="font-serif text-lg">{{ $word->english }}</span><span
                                    class="text-gray-700"> by {{ is_null($word->user_id) ? 'Anonymous User' : $word->user->name }}</span>
                                </span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        @php
            $files = File::allFiles(public_path('images/backgrounds'));
            $randomFile = $files[rand(0, count($files) - 1)];
        @endphp

        <style>
            .custom-bg {
                background-image: url('/images/backgrounds/{{ $randomFile->getBasename() }}');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                backdrop-filter: blur(100px);
            }
        </style>
</x-app-layout>
