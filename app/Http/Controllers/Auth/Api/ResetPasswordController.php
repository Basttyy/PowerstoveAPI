<?php

namespace App\Http\Controllers\Auth\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Response;

class ResetPasswordController extends Controller
{
    /**
     * Send reset password email
     */
    public function sendResetLink(Request $request)
    {
        //check email address is valid
        $this->validate($request, ['email' => 'required|email']);

        //send password reset to the user with this email address
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response == PASSWORD::RESET_LINK_SENT) {
            return response()->json([
                "message" => "password reset link sent to email"
            ], response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "unable to send password reset link"
            ], response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        //check for valid input
        $rules = [
            'token' => 'required|string',
            'username' => 'required|string|email',
            'password' => 'required|min:6'
        ];
        $this->validate($request, $rules);

        //reset the password
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->save();
            }
        );

        if ($response == PASSWORD::PASSWORD_RESET) {
            return response()->json([
                "message" => "password reset successfully"
            ], response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "unable to reset password"
            ], response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * change the password
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        if (auth()->user()->password = Hash::make($request->only('password'))) {
            return response()->json([
                'message' => 'password changed successfully'
            ], response::HTTP_OK);
        }
        return response()->json([
            'message' => 'unable to change password'
        ], response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('username', 'password', 'password_confirmation', 'token');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        $passwordBrokerManager = new PasswordBrokerManager(app());
        return $passwordBrokerManager->broker();
    }
}
