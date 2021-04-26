<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Results for ') }} <i>{{$term}}</i>
        </h2>
    </x-slot>

    @if(count($results) != 0)
        @include('partials.word-list', ['words'=>$results])
    @else
        @include('partials.word-not-found')
    @endif

    <style>
        .word-item {
            cursor: pointer;
        }
    </style>

</x-app-layout>
