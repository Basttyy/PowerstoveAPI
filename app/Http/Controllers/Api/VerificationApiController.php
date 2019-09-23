<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;

class VerificationApiController extends Controller
{
    use VerifiesEmails;

    /**
     * Show email verification notice.
     */
    public function show()
    {
        //
    }

    /**
     * Mark the authenticated user's email as verified
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $userId = $request->id;
        $user = User::FindOrFail($userid);
        $date = date("Y-m-d g:i:s");

        $user->email_verified_at = $date;       //to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature

        $user->save();

        return response()->json("email verified");
    }

    /**
     * Resend Verification notification.
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json("user have verified email already", 422);
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json("email verification link resent");
    }
}
