<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response{
        Gate::authorize('create', User::class);

        return Inertia::render('Auth/Register', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse{
        Gate::authorize('create', User::class);

        $request->validate([
            'nickname' => 'required|string|max:15|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'exists:roles,id']
        ]);

        $user = User::create([
            'nickname' => $request->nickname,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->integer('role'));

        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
