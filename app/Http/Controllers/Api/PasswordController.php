<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordNotification;

class PasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'status' => $response == Password::RESET_LINK_SENT
                ? 'Password reset link sent.'
                : 'Failed to send reset link.',
        ]);
    }

}
