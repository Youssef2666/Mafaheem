<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\OtpVerifyRequest;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    use ResponseTrait;
    public function __construct(private Otp $otp)
    {
        $this->otp = $otp;
    }
    public function register(RegisterRequest $request)
    {
        try {
            // Create the user
            $user = User::create(
                $request->validated(),
            );

            // $user->notify(new EmailVerificationNotification($user->email, $this->otp));
            // Generate token
            $token = $user->createToken('auth_token')->plainTextToken;
            // $user->sendEmailVerificationNotification();
            return $this->successWithToken(message: 'We sent you a LINK, check your email', code: 201, token: $token);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }
    public function whoAmI()
    {
        $user = Auth::user();

        if ($user->image) {
            $user->image = asset('storage/' . $user->image);
        }

        return $this->success($user);
    }

    public function login(LoginRequest $request)
    {
        try {
            $request->validated($request->all());
            if (!Auth::attempt($request->only('email', 'password'))) {
                return $this->error('Credentials do not match', 401);
            }
            $user = User::where('email', $request['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->successWithToken($user, token: $token);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function verifyOtp(OtpVerifyRequest $request)
    {
        try {
            $email = $request->input('email');
            $otpCode = $request->input('otp');

            $otpValidation = $this->otp->validate($email, $otpCode);

            if (!$otpValidation->status) {
                return $this->error('Invalid or expired OTP.', 400);
            }

            // OTP is valid, mark the user as verified
            $user = User::where('email', $email)->first();
            $user->email_verified_at = now(); // Mark the user as verified
            $user->save();

            return $this->success('OTP verified successfully.');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->success('Logged out successfully');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function getUsers(Request $request)
    {
        $users = User::all();
        return $this->success($users);
    }

    public function resendEmailVerification(Request $request)
    {
        Auth::user()->sendEmailVerificationNotification();
        return $this->success('Email verification link sent.');
    }

    public function verify(Request $request, $id, $hash)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Check if the hash matches
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['error' => 'Invalid verification link'], 403);
        }

        // Check if the user has already verified their email
        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 200);
        }

        // Mark the user as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        $message = 'Email verified successfully';
        return view('email', compact('message'));
    }
}
