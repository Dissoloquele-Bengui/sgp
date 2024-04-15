<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;
    //
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            // $token = $request->user()->createToken('invoice')->plainTextToken;
            $user=User::where('email',$request->email)->first()->toJson();
            
            return response()->json(['message' => 'Authorized', 'token' => $request->user()->createToken('auth_token')->plainTextToken,'user'=> $user], 200);
        } else {
            return response()->json(['message' => 'Not Authorized', 'message_2' => 'Credenciais não encontradas'], 403);

        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Token Revoked', 200);
    }


}
