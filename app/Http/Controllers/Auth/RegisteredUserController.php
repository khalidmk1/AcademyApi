<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\UserRole;
use App\Models\UserClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
/* use Illuminate\Auth\Events\Registered; */

class RegisteredUserController extends Controller
{

    public function create(){
        $roles = Role::all();

        return view('Component.Auth.register')->with('roles' , $roles);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {

        $role_admin = Role::where('role_name' , 'Super Admin')->first();

        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user_role = UserRole::create([
            'user_id' =>$user->id,
            'role_id' => $role_admin->id
        ]);


       /*  event(new Registered($user)); */

        /* Auth::login($user); */

        return response([$user , 'api_token' => $request->bearerToken()]);
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store_api(Request $request)
    {

        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $role_client = Role::where('role_name' , 'Client')->first();

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $user_role = UserRole::create([
            'user_id' =>$user->id,
            'role_id' => $role_client->id
        ]);

         return response()->json(['user' => $user]);
    }
}
