<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative flex items-center w-full mb-6">
                <div class="flex items-center w-full rounded-lg shadow-md">
                    <input id="search-bar" class="block w-full p-4 text-xl border border-gray-200 rounded-lg"
                           autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false" type="text"
                           placeholder="{{ \Backpack\Settings\app\Models\Setting::get('search_bar_placeholder') }}">
                    <div class="absolute inset-y-0 right-0 flex items-center justify-center mr-5">
                        <x-gmdi-double-arrow-r style="width: 1.5rem" onclick="search()"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-row flex-wrap items-stretch">
            <div class="lg:max-w-4xl flex-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>{{ \Backpack\Settings\app\Models\Setting::get('homepage_intro_title') }}</h2>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        {!! \Backpack\Settings\app\Models\Setting::get('homepage_intro_content') !!}
                    </div>
                </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-auto flex-column sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="cursor: pointer"
                     onclick="window.location.href='{{ route('view', $word->id) }}'">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b>Word of the Day</b>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b>English</b> <span class="font-serif"> {{ $word->english }}</span>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b>Pronunciation</b> <span class="font-serif"> {{ $word->pronunciation }}</span>
                    </div>
                </div>

                <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b>Recent Updates</b>
                    </div>
                    @foreach($recent_updates as $word)
                        <div class="p-6 bg-white border-b border-gray-200" style="cursor:pointer;"
                             onclick="window.location.href='{{ route('view', $word->id) }}'">
                            <span class="font-serif text-lg">{{ $word->english }}</span> by <span
                                class="font-italic">{{ is_null($word->user_id) ? 'Anonymous' : $word->user->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            </di
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
            }
        </style>

        @push('scripts')
            <script>
                $('#search-bar').on('keyup', function (e) {
                    if (e.key === 'Enter' || e.keyCode === 13) {
                        search();
                    }
                })

                function search() {
                    const searchValue = document.getElementById('search-bar').value;
                    if (searchValue) {
                        window.location.href = '{{ url('/search') }}/' + searchValue;
                    }
                }
            </script>
    @endpush
</x-app-layout>
