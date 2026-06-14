@extends('layouts.auth')

@section('title')
    Registro de Usuario
@endsection

@section('auth-contents')
<form method="POST" action={{ route('register.store') }} class="mt-14 space-y-5" novalidate>
    <div class="space-y-2">
        <label class="font-bold text-2xl block" for="name">Nombre</label>

        <input
            id="name"
            type="text"
            placeholder="Introduce tu Nombre"
            class="w-full border border-gray-300 p-3 rounded-lg"
            name="name"
            value="{{ old('name') }}"
        />
    </div>

    @error('name')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
    @enderror

    <div class="space-y-2">
        <label class="font-bold text-2xl block" for="email">Email</label>

        <input
            id="email"
            type="email"
            placeholder="Introduce tu Email"
            class="w-full border border-gray-300 p-3 rounded-lg"
            name="email"
            value="{{ old('email') }}"
        />
    </div>

    @error('email')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
    @enderror

    <div class="space-y-2">
        <label class="font-bold text-2xl block">Password</label>

        <input
            type="password"
            placeholder="Introduce tu Password"
            class="w-full border border-gray-300 p-3 rounded-lg"
            name="password"
        />
    </div>

    @error('password')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
    @enderror

    <div class="space-y-2">
        <label class="font-bold text-2xl block" for="password_confirmation">Repetir Password</label>

        <input
            type="password"
            placeholder="Repite tu Password"
            class="w-full border border-gray-300 p-3 rounded-lg"
            name="password_confirmation"
        />
    </div>


    <input
        type="submit"
        value='Registrarme'
        class="bg-purple-950 hover:bg-purple-800 w-full p-3 rounded-lg text-white font-bold  text-xl cursor-pointer" />
</form>
@endsection

