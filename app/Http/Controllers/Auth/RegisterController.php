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
        $data = $request->validated();

        //Almacena en la base de datos
        $user = User::create($data);
        event(new Registered($user));

        Auth::login($user);
    }

}
