<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnArgument;
use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    // Register user
    public function register(Request $request)
    {
        // validate
        $useFields = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        // register
        $user = User::create($useFields);
        // login
        Auth::login($user);

        //    redirect
        return redirect()->route('home')->with('success', 'User registed successfully.');;
    }
    public function login(Request $request)
    {
        $user = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        // dd('loading');
        if (Auth::attempt($user, $request->remember)) {
            //    redirect
            return redirect()->intended('dashboard');
        } else {
            //    redirect
            return back()->withErrors([
                'failed' => 'The provided credentaials do not match our records'
            ]);
        };
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return   redirect('/');
    }
}
