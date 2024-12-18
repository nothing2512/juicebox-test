<?php

namespace App\Http\Controllers;

use App\Jobs\MailSender;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login() {

        request()->validate([
            "email" => "required|max:255",
            "password" => "required|max:255"
        ]);

        $email = request()->post("email");
        $password = request()->post("password");

        $user = User::query()->where("email", "=", $email)->first();
        if ($user == null) {
            return response()->json([
                "message" => "email is not registered"
            ], 400);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                "message" => "invalid password"
            ], 400);
        }

        $token = $user->createToken("token");

        return response()->json([
            "token" => $token->plainTextToken,
            "user" => $user,
        ]);
    }

    function register() {
        request()->validate([
            "name" => "required|max:255",
            "email" => "required|max:255|unique:users,email",
            "password" => "required|max:255"
        ]);
        
        $user = new User();
        $user->fill(request()->all());
        $user->save();
        $token = $user->createToken("token");

        MailSender::dispatch($user);

        return response()->json([
            "token" => $token->plainTextToken,
            "user" => $user,
        ]);
    }

    function logout() {
        request()->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
