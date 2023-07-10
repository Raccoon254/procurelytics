@extends('layouts.app')

@section('title', 'Procurement Data Table')

@section('content')

    <section class="p-3 sm:p-6">
        @livewireStyles
        @livewire('procurement-data-table')
        @livewireScripts
    </section>

@endsection
