@extends('layouts.base')

@section('contents')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @yield('actions')
    </div>

    <main class="mt-5 max-w-5xl mx-auto p-5 lg:p-10 mb-20">
        @yield('dashboard-contents')
    </main>


@endsection
