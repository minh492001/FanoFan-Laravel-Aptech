<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{

    /**
     * Handle an incoming password reset link request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'token.required' => 'Missing token..',
            'email.required' => 'Must fill the email',
            'email.email' => 'Email invalid',
            'password.required' => 'Must fill the password',
            'password.confirmed' => 'Your password does not match...'
        ]);
        /** @var User $user * */
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'), function ($user) use ($request) {
            $user->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ])->save();
            event(new PasswordReset($user));
        }
        );
        if ($status !== Password::PASSWORD_RESET){
            throw ValidationException::withMessages([
                'email'=> [__($status)]
            ]);
        }
        return response([$status => __($status)]);
    }



    //    public function forgotPassword (Request $request)
    //    {
    //        $user = User::where('email', $request->email)->firstOrFail();
    //        $passwordReset = PasswordReset::updateOrCreate([
    //            'email' => $user->email,
    //        ], [
    //            'token' => Str::random(60),
    //        ]);
    //        if ($passwordReset) {
    //            $user->notify(new ResetPasswordRequest($passwordReset->token));
    //        }
    //
    //        return response()->json([
    //            'message' => 'We have e-mailed your password reset link!'
    //        ]);
    //    }

    //    public function resetPassword (Request $request, $token)
    //    {
    //        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
    //        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
    //            $passwordReset->delete();
    //
    //            return response()->json([
    //                'message' => 'This password reset token is invalid.',
    //            ], 422);
    //        }
    //        $user = User::where('email', $passwordReset->email)->firstOrFail();
    //        $updatePasswordUser = $user->update($request->only('password'));
    //        $passwordReset->delete();
    //
    //        return response()->json([
    //            'success' => $updatePasswordUser,
    //        ]);
    //    }
}
