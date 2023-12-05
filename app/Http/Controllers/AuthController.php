<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequset;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
use Cookie;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    // /////post request to register
    public function register(RegisterRequset $request)
    {
        $user = User::create(
            $request->only("first_name", "last_name", "email")
                + [
                    "password" => Hash::make($request->input("password")),
                    "is_admin" => $request->path() === "api/admin/login" ? 1 : 0,
                    // "is_admin" => 1
                ]
        );

        return response()->json($user, Response::HTTP_CREATED);
    }
    // /////////Post request for login
    public function login(Request $request)
    {

        if (!(Auth::attempt($request->only("email", "password")))) {
            // HTTP_UNAUTHORIZED
            return response([
                "error" => "invalid credotional"
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        ////
        $adminLogin = $request->path() === "api/admin/login";
        if ($adminLogin && !$user->is_admin) {
            ///prvenet login
            // HTTP_UNAUTHORIZED
            return response([
                "error" => "Acesses denied"
            ], Response::HTTP_UNAUTHORIZED);
        }

        ////diffine the scope role
        $scope = $adminLogin ? "admin" : "ambassador";
        $jwt = $user->createToken("token", [$scope])->plainTextToken; ///create token for user login.
        $cookie = cookie("jwt", $jwt, 60 * 24); ///save in cookcie for 1 day.
        return response([
            "message" => "You have successfully logged in"
        ])->cookie($cookie);
    }
    ////GET request to get user data
    public function user(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }
    ////POST requst to logout
    public function logout()
    {
        $cookie = Cookie::forget("jwt"); /////clean token string from the cookie
        return response([
            "message" => "You have successfully logged out"
        ])->cookie($cookie);
    }
    ////POST requst for update info user
    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = $request->user();
        $user->update($request->only("first_name", "last_name", "email")); ///make and svae changes.
        return response($user, Response::HTTP_ACCEPTED);
    }
    ////POST requst for update info user - password
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        $user->update([
            "password" => Hash::make($request->input("password"))
        ]); ///make and svae changes.
        return response($user, Response::HTTP_ACCEPTED);
    }
}
