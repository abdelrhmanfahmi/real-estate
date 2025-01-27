<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequestForm $request)
    {
        try{
            $data = $request->validated();
            $credentials = $request->except(['_token']);

            if (Auth::attempt($credentials)) {
                return redirect()->intended('home');
            }

            return redirect()->back()->withErrors(['msg' => 'email or password incorrect']);
        }catch(\Exception $e){
            return $e;
        }
    }

    public function logout()
    {
        try{
            Auth::logout();
            return redirect()->route('login');
        }catch(\Exception $e){
            return $e;
        }
    }
}
