<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Auth;
use Validator;

class CustomerController extends Controller
{

        public function signIn(Request $request)
    {
        $email = $request->input('email');
        $key = 'login-attempts:' . $email;

        if ($request->ajax()) {
            $data = $request->all();

            // Check for rate limiting
            if (RateLimiter::tooManyAttempts($key, 5)) {
                return response()->json(['type' => 'error', 'message' => 'Too many login attempts. Please try again later.']);
            }

            $validator = Validator::make($request->all(), [

                'g-recaptcha-response' => 'required',
            ], [
                'g-recaptcha-response.required' => 'reCaptcha is required!',
            ]);

            if ($validator->passes()) {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    // Clear the rate limiter on successful login
                    RateLimiter::clear($key);

                    $redirectTo = url('/');

                    return response()->json(['type' => 'success', 'url' => $redirectTo]);
                } else {
                    // Increment the rate limiter attempts
                    RateLimiter::hit($key);

                    return response()->json(['type' => 'incorrect', 'message' => 'Incorrect Email or Password!']);
                }
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->messages()]);
            }
        }
    }
    public function signUp(Request $request)
    {
        $data = $request->validated();

        // Create the Customer
        User::create([
            'firstname' => $data['Fname'],
            'lastname' => $data['Lname'],
            'address' => $data['address'],
            'phone_num' => $data['phone_num'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('signin')->with('success', 'Account created successfully. Please sign in.');
    }

    public function Logout(){
        Auth::logout();

        return redirect('/');
    }

}
