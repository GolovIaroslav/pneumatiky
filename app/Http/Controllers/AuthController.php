<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'repeatpassword' => 'required|same:password',
        ], [
            'username.required' => 'Meno je povinné.',
            'username.unique' => 'Toto prihlasovacie meno už existuje.',
            'email.unique' => 'Tento e-mail už existuje.',
            'password.min' => 'Heslo musí mať aspoň 8 znakov.',
            'repeatpassword.same' => 'Heslá sa nezhodujú.',
        ]);

        $user = User::create([
            'name' => trim($validated['username']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        Auth::login($user);
        
        // Zlúč hosťov košík s účtom novoprihláseneho usera
        CartController::mergeGuestCartToDB();

        return redirect()->route('home')->with('success', 'Úspešne ste sa zaregistrovali.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $loginValue = trim($credentials['username']);
        $loginField = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$loginField => $loginValue, 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            
            // Zlúč hosťov košík s prihlásením
            CartController::mergeGuestCartToDB();

            return redirect()->intended('/')->with('success', 'Boli ste úspešne prihlásený.');
        }

        return back()->withErrors([
            'username' => 'Zadané údaje nie sú správne.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Boli ste úspešne odhlásený.');
    }
}
