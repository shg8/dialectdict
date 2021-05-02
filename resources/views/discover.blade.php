<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Discover') }}
        </h2>
    </x-slot>

    @if(\App\Models\Tag::count()>1)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row justify-start items-center">
                    <p class="pl-6 font-bold">Sort By </p>
                    <div class="p-6 bg-white border-b border-gray-200">
                        @foreach($tags as $tag)
                            @include('partials.tag')
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif

    <div id="word-container" class="max-w-7xl mx-auto flex flex-row flex-wrap px-0 lg:px-4">
        @foreach ($words as $word)
            <div class="pt-8 max-w-3xl min-w-min word-item flex-1" onclick="window.location.href='{{route('view', $word)}}'">
                <div class="px-1 sm:px-6 lg:px-4">
                    <div class="card-button rounded-lg">
                        <div class="rounded-lg overflow-hidden bg-white border-gray-200">
                            <div class="flex flex-col justify-around border-b p-6">
                                <p class="text-xl font-serif flex-initial text-center">{{ $word->english }}</p>
                                @if($word->chinese)
                                    <p class="text-lg flex-initial text-center">({{ $word->chinese }})</p>
                                @endif
                            </div>
                            <div class="bg-white border-b p-6">
                                <b>Pronunciation</b> {{ $word->pronunciation }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="pagination" style="display: none">
        <a href="/discover{{ $tag_param }}" class="next">Next</a>
    </div>

    <style>
        body {
            overflow-y: auto;
        }
        .word-item {
            cursor: pointer;
        }
        .card-button {
            position: relative; /* For positioning the pseudo-element */
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.3);
        }

        .card-button::before {
            /* Position the pseudo-element. */
            content: ' ';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            border-radius: 5px;

            /* Create the box shadow at expanded size. */
            box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.5);

            /* Hidden by default. */
            opacity: 0;
            transition: opacity 500ms;
        }

        .card-button:hover::before {
            /* Show the pseudo-element on hover. */
            opacity: 1;
        }
    </style>

    @push('scripts')
        <script
            src="https://unpkg.com/@webcreate/infinite-ajax-scroll@^3.0.0-beta.6/dist/infinite-ajax-scroll.min.js"></script>

        <script>
            let ias = new InfiniteAjaxScroll('#word-container', {
                item: '.word-item',
                next: '.next',
                pagination: '.pagination'
            });
        </script>
    @endpush

</x-app-layout>


