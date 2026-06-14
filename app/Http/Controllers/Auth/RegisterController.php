<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(SignupRequest $request)
    {
        // Validación de los datos del formulario
        $data = $request->validated();

        //Almacena en la base de datos
        $user = User::create($data);

        // Dispara el evento Registered para enviar el correo de verificación
        event(new Registered($user));

        // Autentica al usuario recién registrado
        Auth::login($user);

        // Redirige al usuario a la página de verificación de correo electrónico
        return redirect()->route('verification.notice');
    }

}
