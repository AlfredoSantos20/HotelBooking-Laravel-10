<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Auth;
use Validator;
use Hash;
use Session;


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
        // Validate incoming request data
        $validatedData = $request->validate([
            'Fname' => 'required|string',
            'Lname' => 'required|string',
            'address' => 'required|string',
            'phone_num' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        // Create new User instance
        $saveCustomer = new User();
        $saveCustomer->Fname = $validatedData['Fname'];
        $saveCustomer->Lname = $validatedData['Lname'];
        $saveCustomer->address = $validatedData['address'];
        $saveCustomer->phone_num = $validatedData['phone_num'];
        $saveCustomer->email = $validatedData['email'];

        // Hash the password before saving it
        $saveCustomer->password = bcrypt($validatedData['password']);

        // Save the user to the database
        $saveCustomer->save();

        // Return success response
        return response()->json([
            'message' => 'Account Created Successfully!',
            'status' => 'createdAccount',
        ], 201);
    }

        //Customer Forgot password function
        public function forgotUserPassword(Request $request) {
            if ($request->ajax()) {
                $data = $request->all();

                // Check if email is present in the request
                if (isset($data['email'])) {
                    $email = $data['email']; // Safely capture the email from the request

                    // Validate email
                    $validator = Validator::make($request->all(), [
                        'email' => 'exists:users,email',
                    ], [
                        'email.exists' => 'Email does not exist!'
                    ]);

                    if ($validator->passes()) {
                        // Check if OTP is being sent or verified
                        if (isset($data['otp'])) {
                            // Verify OTP
                            $user = User::where('email', $email)->first();

                            // Check if the OTP is valid and not expired
                            if ($user && $user->otp == $data['otp']) {
                                $otpGeneratedAt = $user->otp_generated_at;
                                if ($otpGeneratedAt && now()->diffInSeconds($otpGeneratedAt) < 60) {
                                    // OTP is correct and not expired
                                    $new_password = Str::random(10);
                                    User::where('email', $email)->update([
                                        'password' => bcrypt($new_password),
                                        'otp' => null,
                                        'otp_generated_at' => null
                                    ]);

                                    // Send new password to the user via email
                                    $messageData = [
                                        'fname' => $user->Fname,
                                        'lname' => $user->Lname,
                                        'email' => $email,
                                        'password' => $new_password
                                    ];
                                    Mail::send('emails.user_forgot_password', $messageData, function($message) use ($email) {
                                        $message->to($email)->subject('New Password - Hotel De Luna');
                                    });

                                    return response()->json([
                                        'type' => 'success',
                                        'message' => 'New password sent to your registered email.'
                                    ]);
                                } else {
                                    return response()->json(['type' => 'error', 'message' => 'OTP expired. Please request a new one.']);
                                }
                            } else {
                                return response()->json(['type' => 'error', 'message' => 'Invalid OTP.']);
                            }
                        } else {
                            // Generate OTP
                            $otp = rand(100000, 999999);
                            User::where('email', $email)->update(['otp' => $otp, 'otp_generated_at' => now()]);

                            // Send OTP to the user's email
                            $userDetails = User::where('email', $email)->first()->toArray();
                            $messageData = [
                                'fname' => $userDetails['Fname'],
                                'lname' => $userDetails['Lname'],
                                'otp' => $otp
                            ];
                            Mail::send('emails.user_otp', $messageData, function($message) use ($email) {
                                $message->to($email)->subject('OTP for Password Reset');
                            });

                            return response()->json([
                                'type' => 'success',
                                'message' => 'OTP sent to your registered email.'
                            ]);
                        }
                    } else {
                        return response()->json([
                            'type' => 'error',
                            'errors' => $validator->messages()
                        ]);
                    }
                } else {
                    return response()->json([
                        'type' => 'error',
                        'message' => 'Email is required.'
                    ]);
                }
            }
        }


    public function Logout(){
        Auth::logout();

        return redirect('/');
    }

}
