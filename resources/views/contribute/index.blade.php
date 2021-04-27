<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contribute') }}
        </h2>
    </x-slot>

    @if(Auth::guest())
        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('login') }}">Log in </a> your {{ config('app.name') }} account to keep track
                        of your contributions. If you are not logged in, your contributions will remain anonymous.
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="block w-full transparent text-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('contribute.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <label class="block">
                                <span class="text-gray-700"><b>Dialect *</b></span>
                            </label>
                            <select name="tags" class="rounded-lg">
                                @foreach($tags as $id => $name)
                                    <option value="{{ $id }}" {{ old('tags') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <label class="block">
                                <span class="text-gray-700"><b>English *</b></span>
                                <input name="english" type="text" value="{{ old('english') }}"
                                       class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                                <span class="text-gray-500">Write the word you want to translate in English</span>
                            </label>
                            <label class="block">
                                <span class="text-gray-700"><b>Pronunciation *</b></span>
                                <input name="pronunciation" type="text" value="{{ old('pronunciation') }}"
                                       class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                                <span class="text-gray-500">Write the approximation of the how the word sounds in your dialect with English letters</span>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">Chinese</span>
                                <input name="chinese" type="text" value="{{ old('chinese') }}"
                                       class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                                <span class="text-gray-500">(Optional) Write the word in Chinese characters</span>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">Context</span>
                                <input name="definition" type="text" value="{{ old('definition') }}"
                                       class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                                <span class="text-gray-500">(Optional) Feel free to include English synonyms, sample sentences, and additional information</span>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">Upload Pronunciation (mp3, wav)</span>
                                <input name="upload" type="file"
                                       class="mt-1 block w-full bg-transparent border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                            </label>
                            <label class="block">
                                <input type="submit"
                                       class="py-2 block w-full bg-transparent text-blue-500 font-semibold border border-blue-600 rounded hover:bg-blue-600 hover:text-white hover:border-transparent transition ease-in duration-200 transform hover:-translate-y-1 active:translate-y-0">
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
