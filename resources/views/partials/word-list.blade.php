<div class="max-w-7xl mx-auto py-12">
    @push('scripts')
        <script src="https://unpkg.com/wavesurfer.js"></script>
    @endpush
    <div class="mx-8 bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col flex-auto">
        @foreach ($words as $word)
            <div class="word-item relative flex p-6 bg-white border-b border-gray-200">
                <div class="block w-full ">
                    @foreach($word->tags as $tag)
                        <span
                            class="m-1 bg-gray-200 rounded-full px-2 font-bold text-sm leading-loose cursor-pointer">{{ $tag->name }}</span>
                    @endforeach
                    <b>{{ $word->english }}</b>
                    <span class="italic">{{ $word->pronunciation }}</span>
                    @if($word->chinese) ({{$word->chinese}}) @endif
                    @if($word->pronunciation_upload)
                        <div class="py-2" style="display: none" id="waveform-{{ $word->id }}"></div>
                    @endif
                </div>
                @if($word->pronunciation_upload)
                    @push('scripts')
                        <script>
                            let wavesurfer{{$word->id}} = WaveSurfer.create({
                                container: document.querySelector('#waveform-{{ $word->id }}'),
                                barWidth: 1,
                                barHeight: 1, // the height of the wave
                                barGap: null // the optional spacing between bars of the wave, if not provided will be calculated in legacy format
                            });

                            wavesurfer{{$word->id}}.load('{{ Storage::url($word->pronunciation_upload) }}');

                            function play{{ $word->id }}() {
                                wavesurfer{{$word->id}}.play();
                            }
                        </script>
                    @endpush
                @endif
                <div class="absolute inset-y-0 right-0 flex items-center justify-center mr-5">
                    @if($word->pronunciation_upload)
                    <x-heroicon-s-play class="w-6" onclick="play{{$word->id}}()"/>
                    @endif
                    <x-gmdi-double-arrow-r style="width: 1.5rem" onclick="window.location.href='{{ route('view', $word->id) }}'"/>
                </div>
            </div>
        @endforeach
    </div>
</div>
