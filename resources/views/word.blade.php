<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $model ? $model->english : 'Missing Definition...' }}
        </h2>
    </x-slot>

    @if($model)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-gray-200">
                        <p class="font-serif text-6xl text-center">{{ $model->english }}</p>
                    </div>
{{--                    <div class="p-6 pt-0 flex justify-center border-b border-gray-200">--}}
{{--                        @foreach($model->tags as $tag)--}}
{{--                            @include('partials.tag')--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                    @if($model->chinese)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p class="font-serif text-6xl text-center">{{ $model->chinese }}</p>
                        </div>
                    @endif
                    @if($model->pronunciation)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <b>Pronunciation</b> <span class="font-serif">{{ $model->pronunciation }}</span>
                        </div>
                    @endif
                    @if($model->definition)
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{ $model->definition }}
                        </div>
                    @endif
                    @if($model->pronunciation_upload)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="py-2" id="waveform"></div>
                            <button type="button" onclick="play()"
                                   class="py-2 block w-full bg-transparent text-blue-500 font-semibold border border-blue-600 rounded hover:bg-blue-600 hover:text-white hover:border-transparent transition ease-in duration-200 transform hover:-translate-y-1 active:translate-y-0">
                                Play Pronunciation
                            </button>
                        </div>
                    @endif
                    @if($model->user_id)
                        <div class="p-6 bg-white border-b border-gray-200">
                            Uploaded by {{ $model->user->name }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        @include('partials.word-not-found')
    @endif

    @push('scripts')
        <script src="https://unpkg.com/wavesurfer.js"></script>
        <script>
            let wavesurfer = WaveSurfer.create({
                container: document.querySelector('#waveform'),
                barWidth: 2,
                barHeight: 1, // the height of the wave
                barGap: null // the optional spacing between bars of the wave, if not provided will be calculated in legacy format
            });

            wavesurfer.load('{{ Storage::url($model->pronunciation_upload) }}');

            function play() {
                wavesurfer.play();
            }
        </script>
    @endpush

</x-app-layout>
