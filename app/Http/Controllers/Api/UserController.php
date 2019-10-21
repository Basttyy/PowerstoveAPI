<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Role;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->authorizeRoles(['super_admin', 'admin', 'agent']);

        return $this->userCheck();
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  App\Http\Requests\User\StoreUserRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreUserRequest $request)
    // {
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'avatar' => $request->avatar
    //     ]);
    //     $user->roles()->attach(Role::where('id', Auth::user()->roles()->first()->id + 1)->first());

    //     return response(
    //         new UserResource($user),
    //         response::HTTP_CREATED
    //     );
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        auth()->user()->authorizeRoles(['super_admin', 'admin', 'agent']);  //only super_admin, admin and agent allowed

        if ((auth()->user()->id === $user->admin_id)||(auth()->user()->id === $user->agent_id)||(auth()->user()->id < 5)) {
            return response(
                new UserResource($user),
                response::HTTP_OK
            );
        } else {
            abort(response::HTTP_UNAUTHORIZED, 'you are not authorized');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->email = $request->email;
        $user->name = $request->name;
        $user->update();

        return response(
            new UserResource($user),
            response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        auth()->user()->authorizeRoles('super_admin');
        $user->delete();

        return response([
                'message' => 'deleted successfully'
            ], response::HTTP_OK);
    }

    //check user priority and return appropraite user collection
    public function userCheck()
    {
        if (auth()->user()->roles()->first()->name == 'super_admin') {
            return UserCollection::collection(User::paginate(20));      //return all users if authenticated user is super_admin
        }
        if (auth()->user()->roles()->first()->name == 'admin') {    //return only users registered under an admin
            return UserCollection::collection(User::whereAdmin_idOrAgent_id(auth()->user()->id, auth()->user()->id)->paginate(20));
        }
        if (auth()->user()->roles()->first()->name == 'agent') {    //return all users that are registered under an agent
            return UserCollection::collection(User::where('agent_id', auth()->user()->id)->get()->paginate(20));
        }
    }
}
