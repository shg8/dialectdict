<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Fuzhounese') }}
        </h2>
    </x-slot>

    @if(!empty(\Backpack\Settings\app\Models\Setting::get('about_story')))
        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {!! \Backpack\Settings\app\Models\Setting::get('about_story')  !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 sm:gap-12 md:gap-24 lg:gap-48">
                <div class="flex flex-col items-center justify-start bg-white p-12 shadow rounded-lg">
                    <div class="grid grid-flow-row h-full">
                        <div class="row-span-6">
                            <div
                                class="inline-flex shadow-lg border border-gray-200 rounded-full overflow-hidden h-40 w-40">
                                <img src="{{ url('/images/about/noah.jpg') }}"
                                     class="h-full">
                            </div>

                            <h2 class="mt-4 font-bold text-xl">Noah Lee</h2>
                            <h6 class="mt-2 text-sm font-medium">Co-Founder's Statement</h6>


                            <p class="text-md-left text-gray-700 mt-3">
                                The origins of this dictionary came from my desire to connect with my family’s heritage.
                                My mom’s side of the
                                family speaks a dialect of Chinese called Fuzhounese and I’ve always wanted to learn the
                                language so I could communicate with them, especially since some of them don’t speak
                                English.
                                While studying online, I noticed that there were few resources for learning
                                Fuzhounese—or any
                                Chinese dialect besides Cantonese and Mandarin for that matter.

                                By creating this website, my goal is to help other Chinese diaspora share their
                                knowledge and
                                learn more about their background through language.
                            </p>
                        </div>
                        <ul class="flex flex-row mt-4 space-x-2">
                            <li>
                                <a href="mailto:hgao@exeter.edu"
                                   class="flex items-center justify-center h-12 w-12 border rounded-full text-gray-800 border-gray-800 p-2">
                                    <x-gmdi-email-tt class="w-6 h-6"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://instagram.com/noahdarwinlee"
                                   class="flex items-center justify-center h-12 w-12 border rounded-full text-gray-800 border-gray-800 p-2">
                                    <x-bi-instagram class="w-6 h-6"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-start bg-white p-12 shadow rounded-lg">
                    <div class="grid grid-flow-row h-full">
                        <div class="row-span-6">
                            <div
                                class="inline-flex shadow-lg border border-gray-200 rounded-full overflow-hidden h-40 w-40">
                                <img src="{{ url('/images/about/steven.jpg') }}"
                                     class="h-full">
                            </div>

                            <h2 class="mt-4 font-bold text-xl">Steven Gao</h2>
                            <h6 class="mt-2 text-sm font-medium">Co-Founder's Statement</h6>


                            <p class="text-md-left text-gray-700 mt-3">
                                Language, as a medium of culture and tradition, has always fascinated me growing up. The
                                crowd-sourcing approach of this dictionary seeks to reflect the diversity and
                                colorfulness
                                of Asian American culture, allowing us to comprehend the lived experience of different
                                members of the community. In the backdrop of anti-Asian violence, words empower us,
                                forge
                                identities, and provide solidarity through common experiences. By developing this
                                website, I
                                hope to advance this objective through the power of technology.
                            </p>
                        </div>
                        <ul class="flex flex-row mt-4 space-x-2">
                            <li>
                                <a href="mailto:hgao@exeter.edu"
                                   class="flex items-center justify-center h-12 w-12 border rounded-full text-gray-800 border-gray-800 p-2">
                                    <x-gmdi-email-tt class="w-6 h-6"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/stevenhgao/"
                                   class="flex items-center justify-center h-12 w-12 border rounded-full text-gray-800 border-gray-800 p-2">
                                    <x-bi-linkedin class="w-6 h-6"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
