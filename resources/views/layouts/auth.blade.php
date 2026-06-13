@extends('layouts.base')

@section('contents')

    <main class="max-w-2xl mt-10 mx-auto p-10 shadow-lg">
        <h1 class="text-4xl font-bold text-center mb-10">@yield('title')</h1>
         @yield('auth-contents')
    </main>

@endsection
