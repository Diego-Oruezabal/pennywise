<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(SignInRequest $request)
    {
        $data=$request->validated();

        if(!Auth::attempt($data)){
            return back()->with('error', 'Credenciales incorrectas. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('dashboard');
    }
}
