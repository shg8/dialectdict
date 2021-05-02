<span id="tag{{$tag->id}}" class="m-1 rounded-full px-2 font-bold text-sm leading-loose cursor-pointer" onclick="window.location.href='{{ route('discover.tagged', $tag->name) }}'">{{ $tag->name }}</span>
<style>
    #tag{{$tag->id}}{
        background-color: {{ $tag->color }};
        color: {{getContrastColor($tag->color)}};
    }
    #tag{{$tag->id}}:hover{
        background-color: {{ adjustBrightness($tag->color, -30) }};
    }
</style>
