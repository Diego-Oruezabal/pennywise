@extends('layouts.auth')

@section('title')
    Administra tus Presupuestos

@section('auth-contents')

    <h1 class="text-4xl font-black text-center">Bienvenido {{ auth()->user()->name }}</h1>

    @if (session('success'))
      <x-alert type="success" :message="session('success')" />
    @endif


@endsection
