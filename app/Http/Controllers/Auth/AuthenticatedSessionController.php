<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;


class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('Component.Auth.login');
    }

    
    public function email_verify(){
        return view('Component.Auth.verify-email');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        
        $request->authenticate();

        $request->session()->regenerate();
    
        return redirect()->route('dashboard.index'); 
        
    }


    /**
     * Handle an incoming authentication request.
     */
    public function login_api(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();
            $user->update([
                'is_login' => 1
            ]);
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token]);
        }
    
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    
        
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

       return response()->json();
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy_api(Request $request)
    {
       
       $user = $request->user();

       $user->tokens()->delete();
        
       $user->update([
           'is_login' => 0,
       ]);


       return response()->json(['message' => 'Logged out successfully']);
       

    }



}
