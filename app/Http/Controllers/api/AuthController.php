<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where([
            'email'=>$request->input('email'),
            'password'=>$this->encrypt_password($request->input('password')),
//                'status'=>1
        ])->first();

        if ($user) {
            Auth::login($user);
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function resetPassword(Request $request){
        $response['data'] = $request->all();
        $user = User::where([
            'user_id'=>Auth::user()->user_id,
            'password'=>$this->encrypt_password($request->current_password),
        ])->first();
        if($user){
            $user->update([
                'password' => $this->encrypt_password($request->new_password),
            ]);
            $error['current_password'] = null;
        } else{
            $error['current_password'] = 'Current Password Not Matched!';
        }
        $response['user old'] = Auth::user()->password;
        $response['user new'] = $this->encrypt_password($request->current_password);
        $response['errors'] = $error;
        $response['user'] = $user;
        $response['status'] = "Success";
        return response()->json($response);
    }

    private function encrypt_password($password)
    {
        return sha1(md5($password . 'Looper$alt'));
    }
}