<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Foundation\Auth\VerifiesEmail;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use VerifiesEmail;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Signup a new user to the system.
     *
     * @param  App\Http\Requests\User\StoreUserRequest  $request
     * @return \Illuminate\Http\UserResource
     */
    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar
        ]);
        $user->roles()->attach(Role::where('id', Auth::user()->roles()->first()->id + 1)->first());
        $user->sendApiEmailVerificationNotification();

        return response([
                'success' => 'please confirm your email by clicking on verify user button sent to you on your email'
            ], response::HTTP_CREATED
        );
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            $this->username() => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only([$this->username(), 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized User'], Response::HTTP_UNAUTHORIZED);
        }
        if (auth()->user()->email_verified_at !== NULL)
            return $this->respondWithToken($token);
        else
            return response()->json(['error' => 'please verify email'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(
            new UserResource(auth()->user()),
            response::HTTP_OK
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => new UserResource(auth()->user()),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], response::HTTP_OK);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
