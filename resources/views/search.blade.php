<x-app-layout>
    @push('scripts')
        <script src="https://unpkg.com/wavesurfer.js"></script>
    @endpush
    <div class="max-w-7xl mx-auto py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 w-full">
            <div class="col-span-2 sm:px-6 lg:px-8 flex flex-col">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h2>{!! \Backpack\Settings\app\Models\Setting::get('homepage_intro_title')  !!}</h2>
                    </div>
                    <div class="p-6 border-b border-gray-200">
                        {!! \Backpack\Settings\app\Models\Setting::get('homepage_intro_content') !!}
                    </div>
                </div>
                <div class="pt-12">
                    <div class="max-w-7xl mx-auto">
                        <div class="relative flex items-center justify-center w-full mb-6">
                            <div class="flex items-center w-full rounded-full shadow-md">
                                <input
                                    id="search-bar-main"
                                    class="search-bar block w-full p-4 text-xl border border-gray-200 rounded-full bg-white bg-opacity-90 focus:border-purple-900"
                                    autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false" type="text"
                                    placeholder="{!! \Backpack\Settings\app\Models\Setting::get('search_bar_placeholder')  !!}">
                                <button type="button" class="absolute inset-y-0 right-0 flex items-center justify-center mr-5">
                                    <x-gmdi-double-arrow-r style="width: 1.5rem" onclick="search($('#search-bar-main').val())"/>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($word))
                <div class="mt-6 lg:mt-0 flex flex-col sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg" style="cursor: pointer"
                         onclick="window.location.href='{{ route('view', $word->id) }}'">
                        <div class="p-6 border-b border-gray-200 text-center font-bold">
                            Word of the Day
                        </div>
                        <div class="p-6 pb-3 border-gray-200 w-full">
                            <p class="font-serif text-xl text-center">{{ $word->english }}</p>
                        </div>
                        @if($word->pronunciation || $word->pronunciation_upload)
                            <div class="py-2 hidden" id="waveform-{{ $word->id }}"></div>
                            <div class="p-6 pt-3 border-b border-gray-200 flex flex-row justify-center">
                                @if($word->pronunciation)<span
                                    class="font-serif"> {{ $word->pronunciation }}</span>@endif
                                @if($word->pronunciation_upload)
                                    <x-heroicon-s-play class="w-6 h-6 ml-2" id="play{{$word->id}}"/>
                                    @push('scripts')
                                        <script>
                                            let wavesurfer{{$word->id}} = WaveSurfer.create({
                                                container: document.querySelector('#waveform-{{ $word->id }}'),
                                                barWidth: 1,
                                                barHeight: 1, // the height of the wave
                                                barGap: null // the optional spacing between bars of the wave, if not provided will be calculated in legacy format
                                            });

                                            wavesurfer{{$word->id}}.load('{{ Storage::url($word->pronunciation_upload) }}');

                                            $("#play{{$word->id}}").click(function (e) {
                                                e.stopPropagation();
                                                wavesurfer{{$word->id}}.play();
                                            });
                                        </script>
                                    @endpush
                                @endif
                            </div>
                        @endif
                        <div class="py-4 w-full hover:bg-gray-100">
                            <p class="text-center text-purple-700 ">Learn More</p>
                        </div>
                    </div>

                    <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 text-center font-bold">
                            Recent Updates
                        </div>
                        @foreach($recent_updates as $word)
                            <div class="pl-6 p-4 @if(!$loop->last) pb-0 @endif hover:underline cursor-pointer flex flex-row justify-start items-end" onclick="window.location.href='{{ route('view', $word->id) }}'">
                                <span class="font-serif text-xl">{{ $word->english }}</span>
                                &nbsp;
                                <span class="text-gray-700 italic">
                                    by {{ is_null($word->user_id) ? 'Anonymous User' : $word->user->name }}
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

        @if(!$mobile)
            <style>
                .custom-bg {
                    background-image: url('/images/backgrounds/{{ $randomFile->getBasename() }}');
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-size: cover;
                    backdrop-filter: blur(100px);
                }
            </style>
        @endif
</x-app-layout>
