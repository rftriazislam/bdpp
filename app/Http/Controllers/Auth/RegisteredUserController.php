<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
          $district = DB::table('police_stations')->select('zone')->distinct('zone')->orderBy('zone','asc')->get();
          return view('auth.register',compact('district'));
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
            'phone' => ['required', 'string', 'max:13'],
            'birth_day' => ['required'],
            'refer_id' => ['required', 'exists:users,id'],
            'country' => ['nullable'],
            'city' => ['required'],
            'thana' => ['required'],
            'address' => ['nullable', 'string', 'max:300'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'refer_id' => $request->refer_id,
            'birth_day' => $request->birth_day,
            'thana' => $request->thana,
            'country' => $request->country,
            'city' => $request->city,
            'district' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'user',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
