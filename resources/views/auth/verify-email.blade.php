@extends('layouts.auth')

@section('title')
    Confirma tu Cuenta
@endsection

@section('auth-contents')

    <p class="text-center text-gray-600 text-lg">Tu cuenta se ha creado correctamente. Antes de continuar, por favor revisa tu correo electrónico para confirmarla.</p>

    @if(session('success'))
        <x-alert :message="session('success')" />
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mt-5">
        @csrf
        <div class="flex justify-center">
            <input
                type="submit"
                class="bg-amber-500 hover:bg-amber-300 text-white font-bold py-2 px-4 rounded cursor-pointer"
                value='Reenviar Correo de Confirmación'
            />

        </div>
    </form>
@endsection
