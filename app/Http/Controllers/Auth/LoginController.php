<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginInput = $request->input('login');
        $loginColumn = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $loginValue = $loginColumn === 'username' ? strtoupper($loginInput) : $loginInput;

        if (Auth::attempt([$loginColumn => $loginValue, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
