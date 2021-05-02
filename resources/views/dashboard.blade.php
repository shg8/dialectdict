<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You have uploaded {{ Auth::user()->translations()->count() }} words. @if(Auth::user()->translations()->count() > 0) Thank you for your contribution! Here is a list of words uploaded by you. @endif
                </div>
            </div>
        </div>
    </div>

    @include('partials.word-list',['words'=>Auth::user()->translations()->get()])
</x-app-layout>
