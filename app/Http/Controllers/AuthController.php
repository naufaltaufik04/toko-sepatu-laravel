<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $register = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $register['name'],
            'email' => $register['email'],
            'password' => bcrypt($register['password'])
        ]);

        return Response([
            'message' => 'Has successfully registered',
            'user' => $user,
            'token' => $user->createToken('myapptoken')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $login['email'])->first();

        if (!$user || !Hash::check($login['password'], $user->password)) {
            return response([
                'message' => 'Login Failed',
                'response_code' => Response::HTTP_UNAUTHORIZED
            ]);
        }

        return response([
            'message' => 'Login Successfully',
            'response_code' => Response::HTTP_OK,
            'token' => $user->createToken('myapptoken')->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();
    }

    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $status === Password::RESET_LINK_SENT
            ? $temp = ['status' => __($status)]
            : $temp = ['email' => __($status)];
        return response([
            "msg" => 'Reset password link sent on your email id.',
            "test" => $temp
        ]);
    }

    // public function forgot(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);

    //     $token = Str::random(60);

    //     Mail::send('login', ['token' => $token], function ($message) use ($request) {
    //         $message->from($request->email);
    //         $message->to('testlaravel113@gmail.com');
    //         $message->subject('Reset Password');
    //     });

    //     return response([
    //         'message' => 'Check your email message'
    //     ]);
    // }

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "Password has been successfully changed"]);
    }
}
