<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use FileUpload;

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $lock = filter_var(Setting::where('key', 'lock application')->value('value'), FILTER_VALIDATE_BOOLEAN);

        return view('auth.register', compact('lock'));
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_hp' => ['required', 'string', 'max:25'],
            'club' => ['required', 'string', 'max:100', 'unique:users,club'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'manager-team',
            'club' => $request->club,
            'approve_status' => 'approved',
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($request->user()->role == 'manager-team') {
            return redirect()->intended(route('manager-team.dashboard', absolute: false));
        }
    }
}
