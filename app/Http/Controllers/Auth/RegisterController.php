<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Services\AzerothCoreAuth;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        DB::enableQueryLog();

        $request->validate([
            'username' => ['required', 'string', 'max:32', 'unique:auth.account,username'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:auth.account,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $srp6 = AzerothCoreAuth::generateSrp6($request->username, $request->password);

        try {
            $account = Account::create([
                Account::USERNAME => strtoupper($request->username),
                Account::EMAIL     => $request->email,
                Account::REG_MAIL  => $request->email,
                Account::SALT      => $srp6['salt'],
                Account::VERIFIER  => $srp6['verifier'],
                Account::JOINDATE  => now(),
                Account::EXPANSION => 2,
            ]);

            Auth::login($account);

            return redirect()->intended('dashboard');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        dd(DB::getQueryLog());
    }
}
