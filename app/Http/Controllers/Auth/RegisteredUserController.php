<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $config = Configuration::query()->select('agreement')->first();
        return view('auth.register')->with(compact( 'config'));;
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'checkbox' => ['required'],
            'code' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:16', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (Str::contains($request->login, '_')){
            return redirect()->back()->with('error', 'Неверный номер, пожалуйста, перепроверьте');
        }

        $input = $request->code;

        $pattern = "/^\d{0,4}\(\d{0,4}\)$/";

        $isSubstringPresent = preg_match($pattern, $input);

        if (!$isSubstringPresent){
            return redirect()->back()->with('error', 'Неверный код, пожалуйста, перепроверьте');
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'city' => $request->city,
            'code' => $request->code,
            'login' => $request->login,
            'password' => $request->password,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
