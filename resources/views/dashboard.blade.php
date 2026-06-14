@extends('layouts.auth')

@section('title')
    Administra tus Presupuestos

@section('auth-contents')

    <h1 class="text-4xl font-black text-center">Bienvenido {{ auth()->user()->name }}</h1>

    @if (session('success'))
        <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">
            {{ session('success') }}
        </p>
    @endif


@endsection
