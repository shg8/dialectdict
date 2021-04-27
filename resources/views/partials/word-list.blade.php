<div class="max-w-7xl mx-auto py-12">
    <div class="mx-8 bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col flex-auto">
        @foreach ($words as $word)
            <div class="word-item relative flex p-6 bg-white border-b border-gray-200" onclick="window.location.href='{{ route('view', $word->id) }}'">
                <div class="block w-full ">
                    @foreach($word->tags as $tag)
                        <span class="m-1 bg-gray-200 rounded-full px-2 font-bold text-sm leading-loose cursor-pointer">{{ $tag->name }}</span>
                    @endforeach
                    <b>{{ $word->english }}</b> <span class="italic">{{ $word->pronunciation }}</span> @if($word->chinese) ({{$word->chinese}}) @endif
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center justify-center mr-5">
                    <x-gmdi-double-arrow-r style="width: 1.5rem" onclick="search()"/>
                </div>
            </div>
        @endforeach
    </div>
</div>
