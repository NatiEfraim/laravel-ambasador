<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequset;
use App\Models\User;
use Auth;
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
                    "is_admin" => 1
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
        $jwt = $user->createToken("token")->plainTextToken; ///create token for user login.
        $cookies = cookie("jwt", $jwt, 60 * 24); ///save in cookcie for 1 day.
        return response([
            "message" => $jwt
        ])->cookie($cookies);
    }
    public function user(Request $request)
    {
        return $request->user();
    }
}
